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
        if ($serviceType !== null && strcasecmp($nextQuestion->uri, 'selected-service') === 0) {
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
                'currentServiceType' => $serviceType,
                'currentCategory' => $category,
                'currentQuestion' => $question,
                'currentQuestionFields' => $question->guideQuestionFields()->get(),
                'nextCategory' => $nextCategory,
                'nextQuestion' => $nextQuestion,
                'nextQuestionUri' => $nextQuestionUri,
                'isUserIsDeceased' => strcasecmp(\App\Models\UserType::where('title', 'like', '%self%')->first()->id, old('userIsDeceased', session('userIsDeceased'))) === 0
            ]
        );
    }

    /**
     * If the user selected a service and made it to the summary, add an item to the session
     * that shows this submission is complete.
     */
    private function markSubmissionComplete(
        \App\Models\GuideCategory $category,
        \App\Models\GuideQuestion $question
    ) {
        // Do nothing if the next question is not the summary
        if (strcasecmp($category->uri, 'next-steps') !== 0 ||
        $question->guide_category_id !== $category->id ||
        $question->item_order !== 1) {
            return;
        }

        // Add an item, submission-complete, to the session
        session(['submission-complete' => '1']);
    }

    /**
     * Upon clicking Start, clear all session data except the service type, just
     * in case it was set by URL parameter.
     */
    private function clearAllSessionData(
        \App\Models\GuideCategory $category,
        \App\Models\GuideQuestion $question,
        \App\Models\ServiceType $serviceType = NULL
    ) {
        // Do nothing if the current question is not the very first question
        if (strcasecmp($category->uri, 'getting-started') !== 0 ||
        $question->guide_category_id !== $category->id ||
        $question->item_order !== 1) {
            return;
        }

        // Clear all of the session data
        session()->flush();

        Log::debug(__FUNCTION__ . '(); cleared all session data.');

        // Save the service type back to the session if known
        if ($serviceType === null) {
            Log::debug(__FUNCTION__ . '(); no service type saved to re-add to the session');
            return;
        }

        Log::debug(__FUNCTION__ . '(); adding service type to the session: ' . strtolower($serviceType->title));
        session([self::SERVICE_TYPE_PREFIX . 'selection' => self::SERVICE_TYPE_PREFIX . strtolower($serviceType->title)]);
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
        // Validate and store the form submission; if validation fails, then an exception is thrown
        // and the code never progresses past this point
        $validated = $this->validatePage($request, $question);

        Log::debug(__FUNCTION__ . '(); validation succeeded.');

        // If the next-page input is nothing, then stay on the current page
        Log::debug(__FUNCTION__ . '(); current request path: ' . $request->path());
        if (!$request->has('next-page') || !$request->input('next-page')) {
            $nextQuestionUri = $request->path();
            Log::debug(__FUNCTION__ . '(); staying on page ' . $nextQuestionUri);
        } else {
            Log::debug(__FUNCTION__ . '(); advancing to page ' . $nextQuestionUri);
        }

        // If the next question is the summary, then set a session variable
        $this->markSubmissionComplete($nextCategory, $nextQuestion);

        // If the current question is the very first one, then clear everything except the service type
        $this->clearAllSessionData($category, $question, $serviceType);

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
     * Provides question-specific form validation prior to advancing to the next
     * page. The validation rules are loaded from the database for the current question.
     * TODO: Add HTML validation for all required fields
     * @param $request
     * @param $question
     */
    private function validatePage(Request $request, \App\Models\GuideQuestion $question)
    {

        // 1. Get the validation rules for the current question.
        // https://laravel.com/docs/9.x/collections#method-mapwithkeys
        // all() is required to get the underlying array; otherwise, a Collection object is returned
        // https://laravel.com/docs/9.x/collections#method-all

        $validations = $question->guideQuestionFields()->whereNotNull('validation')->get();

        $validationRules = $validations->mapWithKeys(function ($item, $key) {
            return [$item['html_id'] => $item['validation']];
        })->all();

        // To properly specify custom messages for different validation rules, you will need to use
        // the column "required_type" to do so
        // TODO: Make sure to add the required type
        $customMessages = $validations->whereNotNull('validation_msg')->mapWithKeys(function ($item, $key) {
            return [$item['html_id'] . '.' . $item['required_type'] => $item['validation_msg']];
        })->all();

        Log::debug(
            __FUNCTION__ . '(); validation rules for path ' . $request->path() . ': ',
            $validationRules
        );

        Log::debug(
            __FUNCTION__ . '(); custom validation messages for path ' . $request->path() . ': ',
            $customMessages
        );

        return $request->validate($validationRules, $customMessages);
    }
}
