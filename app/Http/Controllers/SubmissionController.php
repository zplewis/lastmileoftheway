<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class SubmissionController extends Controller
{

    const SERVICE_TYPE_PREFIX = 'service-type-';

    /**
     * If a service type is specified by the user, get the associated ServiceType object.
     * @return ServiceType|null
     */
    public static function getSelectedServiceType()
    {
        $value = session('service-type-selection');

        if (!session()->has('service-type-selection') || !$value) {
            return null;
        }

        // Get the service type from the selection
        $title = ucwords(str_replace(self::SERVICE_TYPE_PREFIX, '', $value));

        Log::debug(__FUNCTION__ . '(); dervived service type title: ' . $title);

        return \App\Models\ServiceType::where('title', $title)->first();
    }

    public static function getQuestionsByServiceType(
        \App\Models\ServiceType $serviceType = NULL
    ) {

        if ($serviceType === null) {
            return \App\Models\GuideQuestion::orderBy('guide_category_id')->orderBy('item_order')->get();
        }

        // questions have category IDs and item order
        // pivot table connecting questions to service types

        return \App\Models\GuideQuestion::whereHas('service_type', function ($query) use ($serviceType) {
            $query->where('service_types.id', $serviceType->id);
        })->orderBy('guide_category_id')->orderBy('guide_questions.item_order')->get();
    }

    /**
     * Retrieves questions for a given category based on whether a service type has been selected
     * or not.
     */
    public static function getQuestionsByCategoryByServiceType(
        \App\Models\GuideCategory $category,
        \App\Models\ServiceType $serviceType = NULL
    ) {
        $questions = $category->guideQuestions()->orderBy('guide_category_id')->orderBy('item_order')->get();

        if (!$serviceType) {
            return $questions;
        }

        return $category->guideQuestions()->whereHas('serviceTypes', function ($query) use ($serviceType) {
            $query->where('service_types.id', $serviceType->id);
        })->orderBy('guide_category_id')->orderBy('item_order')->get();

        // Brute force way to do it; I'm pretty sure there is a better way.
        // $filtered = collect();

        // foreach ($questions as $question) {

        //     $found = $question->serviceTypes()->find($serviceType->id);

        //     // Log::debug(__FUNCTION__ . '(); question text: ' . $question->title);
        //     // Log::debug(__FUNCTION__ . '(); service types for question (#1): ', $test);

        //     if (!$found) {
        //         continue;
        //     }

        //     $filtered->push($question);
        // }

        // return $filtered;
    }

    /**
     * Store answers to the current question to the session. When on the final page in next steps,
     * save the answers to the database.
     */
    public function store(Request $request)
    {
        Log::debug(__FUNCTION__ . '(); about to validate the page...');
        // Validate and store the form submission.
        $validated = $this->validatePage($request);

        Log::debug(__FUNCTION__ . '(); request->path(): ' . $request->path());

        self::putAllInputToSession($request);
        Log::debug(__FUNCTION__ . '(); just reflashed input to the session...');

        // If a failure occurred, return to the current request path. Otherwise,
        // go to the next one (if applicable, the last page won't have a next
        // page). The path for the next page comes from the 'next-page' input

        $redirectPath = $request->input('next-page', null);
        Log::debug(__FUNCTION__ . '(); redirect path: ' . $redirectPath);
        if (!$redirectPath) {
            $redirectPath = $request->path();
        }

        // If page validation failed, then $errors->any() will return true
        // https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors

        Log::debug(__FUNCTION__ . '(); redirect path: ' . $redirectPath);
        return redirect($redirectPath)->withInput();
    }

    private function getNextGuideQuestion(
        \Illuminate\Database\Eloquent\Collection $categories,
        \App\Models\GuideCategory $category,
        \App\Models\GuideQuestion $question
    ) {
        $found = false;

        $serviceType = $this::getSelectedServiceType();

        // Brute force it, although there may be a better way...
        foreach ($categories as $sidebarCategory) {

            // Continue until you get to the current category
            if ($sidebarCategory->id < $category->id) {
                // Log::debug(__FUNCTION__ . '(); skipping the category: ' . $sidebarCategory->title);
                continue;
            }

            $questions = $this::getQuestionsByCategoryByServiceType(
                $sidebarCategory,
                $serviceType
            );

            foreach ($questions as $sidebarQuestion) {
                if ($found) {
                    Log::debug(__FUNCTION__ . '(); category: ' . $sidebarCategory->title);
                    Log::debug(__FUNCTION__ . '(); found the next question: ' . $sidebarQuestion->title);
                    return $sidebarQuestion;
                }

                if ($sidebarQuestion->id === $question->id) {
                    $found = true;
                    Log::debug(__FUNCTION__ . '(); category: ' . $sidebarCategory->title);
                    Log::debug(__FUNCTION__ . '(); found the current question!');
                }
            }
        }

        // Reaching this means there is no next question.
        return NULL;
    }

    /**
     * Given a list of questions already in order by category and question item order, get the
     * next question in the list.
     * @param $questions
     * @param $question
     * @param $serviceType
     */
    private function getNextGuideQuestion2(
        \Illuminate\Database\Eloquent\Collection $questions,
        \App\Models\GuideCategory $category,
        \App\Models\GuideQuestion $question = null,
        \App\Models\ServiceType $serviceType = null
    ) {

        $questionInServiceType = false;

        // Get the current question
        // https://laravel.com/docs/9.x/collections#method-skipuntil
        $subset = $questions->skipUntil(function ($item) use ($category, $question) {
            if ($question !== null) {
                $questionInServiceType = true;
                return $item->id === $question->id;
            }
            return $item->guide_category_id === $category->id;
        });

        // Remove the first item, which is the current question
        // https://laravel.com/docs/9.x/collections#method-shift
        $nextQuestion = $subset->shift();

        // If the question cannot be found, default to the first question of the current category
        if ($nextQuestion === null) {
            return $questions->where('guide_category_id', $category->id)->first();
        }

        // Stop here if the question value is null, as the next question would be the first question
        // for the current category for the current service type
        if ($question === null) {
            return $nextQuestion;
        }

        // Therefore, the next item is the next question
        $nextQuestion = $subset->first();
        // If the service type is already known, then skip it and go to the next question
        // This does not affect the sidebar, just what is determined as the next question
        if ($serviceType !== null && strcasecmp($nextQuestion->uri, 'service-type') === 0) {
            $subset->shift();
            $nextQuestion = $subset->first();
        }

        return $nextQuestion;
    }

    /**
     * This function fixes issues with load():
     * Explicit model loading now removes the need to loop to create routes for the guide
     * Detecting the next question is done more reasonably given a sorted list of all questions.
     */
    public function implicitLoad(Request $request, \App\Models\GuideCategory $category, \App\Models\GuideQuestion $question = NULL) {

        // TODO: Find a way to handle when a category is not found; redirect to the second category
        // TODO: Find a way to handle when a question is not found; redirect to the first question of the current category

        // Get current selected service type
        $serviceType = self::getSelectedServiceType();

        // Get all categories
        $allCategories = \App\Models\GuideCategory::orderBy('item_order')->get();

        // Get all questions based on current selected service type (if any, get all questions)
        $allQuestions = self::getQuestionsByServiceType($serviceType);

        // Get the next question based on the current question
        // Defaults to the 1st question of the current category if the question is null
        $nextQuestion = $this->getNextGuideQuestion2($allQuestions, $category, $question, $serviceType);

        // Get the category from the next question
        $nextCategory = $nextQuestion ? $nextQuestion->guideCategory()->first() : null;

        // Get the URI from the next category and question
        $nextQuestionUri = $nextQuestion ? '/guide/' . $nextCategory->uri . '/' . $nextQuestion->uri : null;

        // If the specified question is not valid for this service type, then redirect the user to
        // the current category
        if ($question === null || $allQuestions->where('id', $question->id)->first() === null) {
            // $allQuestions is all questions based on the current service type, if any
            return redirect($nextQuestionUri);
        }

        // Default to the 1st question of the current category if the question is null;
        // this happens when a category is specified but not a question in the URL
        // if ($question === null) {
        //     $question = $this->getNextGuideQuestion2($allQuestions, $category, $question, $serviceType);
        // }

        return view(
            'guide',
            [
                'bible_version' => \App\Models\BibleVersions::where('acronymn', 'NRSV')->first(),
                'categories' => $allCategories,
                'currentServiceType' => self::getSelectedServiceType(),
                'currentCategory' => $category,
                'currentQuestion' => $question,
                'currentQuestionFields' => $question->guideQuestionFields()->get(),
                'nextCategory' => $nextCategory,
                'nextQuestion' => $nextQuestion,
                'nextQuestionUri' => $nextQuestionUri
            ]
        );
    }

    /**
     * Replacement for store() that advances the guide forward or stays on the same page as needed.
     */
    public function advance(Request $request, \App\Models\GuideCategory $category, \App\Models\GuideQuestion $question = NULL) {

        // Get current selected service type
        $serviceType = self::getSelectedServiceType();

        // Get all questions based on current selected service type (if any, get all questions)
        $allQuestions = self::getQuestionsByServiceType($serviceType);

        // Default to the 1st question of the current category if the question is null;
        // this happens when a category is specified but not a question in the URL
        if ($question === null) {
            $question = \App\Models\GuideQuestion::where('guide_category_id', $category->id)->where('item_order', 1)->first();
        }

        // Get the next question based on the current question
        $nextQuestion = $this->getNextGuideQuestion2($allQuestions, $category, $question, $serviceType);

        // Get the category from the next question
        $nextCategory = $nextQuestion ? $nextQuestion->guideCategory()->first() : null;

        // Get the URI from the next category and question
        $nextQuestionUri = $nextQuestion ? '/guide/' . $nextCategory->uri . '/' . $nextQuestion->uri : null;

        // Now that we figured out the next possible question, now attempt to validate the page
        Log::debug(__FUNCTION__ . '(); about to validate the page...');
        // Validate and store the form submission.
        $validated = $this->validatePage($request, $question);

        if (is_array($validated)) {
            Log::debug(__FUNCTION__ . '(); validated (array): ', $validated);
        }
        if (is_object($validated)) {
            Log::debug(__FUNCTION__ . '(); validated (object): ' . $validated);
        }

        // If the next-page input is nothing, then stay on the current page
        Log::debug(__FUNCTION__ . '(); current request path: ' . $request->path());
        if (!$request->has('next-page') || !$request->input('next-page')) {
            $nextQuestionUri = $request->path();
            Log::debug(__FUNCTION__ . '(); staying on page ' . $nextQuestionUri);
        } else {
            Log::debug(__FUNCTION__ . '(); advancing to page ' . $nextQuestionUri);
        }

        // Save all data to the session
        self::putAllInputToSession($request);

        return redirect($nextQuestionUri)->withInput();
    }

    /**
     * Put all inputs from the request into the session, with a few caveats.
     */
    public static function putAllInputToSession(Request $request)
    {
        // https://laravel.com/docs/8.x/requests#retrieving-an-input-value

        Log::debug(__FUNCTION__ . '(); all input: ', $request->all());

        $valuesAreIds = [
            '/^song(Type)*\d*/'
        ];

        foreach ($request->input() as $key => $value) {
            if (strcasecmp($key, 'next-page') === 0) {
                continue;
            }

            // If the key starts with "song" or "songType" and then a number, then the value should
            // be a number (max of 2 characters for 2-digit numbers)
            // https://www.phpliveregex.com/p/DZo
            // foreach ($valuesAreIds as $regex) {
            //     $output_array = [];
            //     $matched = preg_match($regex, $key, $output_array) !== false;

            //     if (count($output_array) === 0) {
            //         continue;
            //     }

            //     if (strcasecmp($output_array[0], $key) === 0 && isset($value) && strlen($value) > 0) {
            //         $value = (trim($value) . '')[0];
            //     }
            // }

            // Save the value to the session
            $request->session()->put($key, $value);
        }

        // Just in case, forget 'next-page' if it's there, as that needs to be fresh every time
        $request->session()->forget('next-page');

        // From the request URI, get the current category and question to see if this question
        // is optional. If it is, and the HTML ID of the optional switch is not in the input,
        // then remove that value from the session
        $parts = explode('/', $request->path());

        if (count($parts) === 3) {
            $category = \App\Models\GuideCategory::where('uri', $parts[1])->first();
            $question = \App\Models\GuideQuestion::where('uri', $parts[2])->where('guide_category_id', $category->id)->first();

            Log::debug(__FUNCTION__ . '(); uri parts: ', $parts);
            Log::debug(__FUNCTION__ . '(); optional_html_id: ' . $question->optional_html_id);
            Log::debug(__FUNCTION__ . '(); optional is yes: ' . $request->has($question->optional_html_id));

            if ($question->optional_html_id &&
            !$request->has($question->optional_html_id)) {
                Log::debug(__FUNCTION__ . '(); setting optional flag to no: ' . $question->optional_html_id);
                $request->session()->put($question->optional_html_id, 'no');
            }
        }

        Log::debug(__FUNCTION__ . '(); all session data: ', session()->all());
    }

    /**
     * Provides page-specific form validation prior to advancing to the next
     * page.
     * TODO: Add validation rules to the database for all required fields, load them for the current
     * question into this function
     * TODO: Add HTML validation for all required fields
     */
    private function validatePage(Request $request, \App\Models\GuideQuestion $question)
    {
        $path = $request->path();

        // Parse the path for the corresponding GuideQuestion object; that way, we can then
        // get validation rules for all fields from the database

        $validated = null;
        // https://laravel.com/docs/8.x/requests#retrieving-the-request-path
        // All validation rules:
        // https://laravel.com/docs/8.x/validation#available-validation-rules
        switch($path)
        {
            case 'guide/demographics/names':
                Log::debug(__FUNCTION__ . '(); made it to case "' . $path . '"');
                // This returns an array, not an object
                $validated = $request->validate([
                    'userFirstName' => 'required|max:50',
                    'userLastName' => 'required|max:50',
                    // 'userEmail' => 'required|email'
                ]);
                break;
        }

        return $validated;
    }



    public static function generateRoutes()
    {
        // The selected service type, if any
        $serviceType = SubmissionController::getSelectedServiceType();

        // This try block seems to be required in order to allow migrations to proceed normally,
        // probably due to the order which models are loaded in the request lifecycle
        try {
            $categories = \App\Models\GuideCategory::orderBy('item_order')->get();

            Log::debug(__FUNCTION__ . '(); current service type: ' . ($serviceType ? $serviceType->title : NULL));
            Log::debug(__FUNCTION__ . '(); routes/web.php - # of guide categories: ' . count($categories));

            foreach ($categories as $category) {
                Log::debug(__FUNCTION__ . '(); category: ' . $category->title);

                // Start off with all questions for the current guide category.
                // However, if there is a service type selected by the user, then only keep those that
                // apply to that selected service type.
                $questions = $category->guideQuestions();

                if ($serviceType) {
                    $questions = $questions->wherePivot('service_type', $serviceType);
                }

                $questions = $questions->get();

                // Add a redirect for /guide
                if ($category->item_order === 1) {
                    Log::debug(__FUNCTION__ . '(); redirect added from / to /guide/' . $category->uri);
                    Route::get('/guide', function(Request $request) use ($category) {

                        $path = '/guide/' . $category->uri;

                        // If a service is passed to /guide and it is a valid service type, then
                        // go ahead and set the service type
                        if ($request->has('service')) {
                            $serviceType = \App\Models\ServiceType::where('title', ucwords($request->input('service')))->first();

                            if ($serviceType !== null) {
                                // Save the service type to the session
                                $request->merge([self::SERVICE_TYPE_PREFIX . 'selection' => self::SERVICE_TYPE_PREFIX . strtolower($serviceType->title)]);
                                self::putAllInputToSession($request);
                            }
                        }

                        return redirect($path);

                    });
                    // Route::redirect('/guide', '/guide/' . $category->uri);
                }

                // For each question type, create a get and post route
                foreach ($questions as $question) {
                    $path = '/guide/' . $category->uri . '/' . $question->uri;
                    Log::debug(__FUNCTION__ . '(); route path: ' . $path);
                    Route::get(
                        $path,
                        function() use ($categories, $category, $question) {
                            return App::call(
                                '\App\Http\Controllers\SubmissionController@load',
                                [
                                    'categories' => $categories,
                                    'category' => $category,
                                    'question' => $question,
                                ]
                            );
                        }
                    );

                    // Add a GET route for the first question in each section of the guide
                    if ($question->item_order === 1) {
                        Log::debug(__FUNCTION__ . '(); redirect added from /' . $category->uri . ' to ' . $path);
                        Route::redirect('/guide/' . $category->uri, $path);
                    }

                    Route::post($path, [SubmissionController::class, 'store']);
                }
            } // end of foreach
        } catch (\Throwable $th) {
            Log::error(__FUNCTION__ . '(); failed to create dynamic routes for guide!');
        }
    }
}
