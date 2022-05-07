<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class SubmissionController extends Controller
{

    const SERVICE_TYPE_PREFIX = 'service-type-';
    public const NUM_REFLECTIONS_PERSONS = 'num_reflections_persons';

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

    /**
     * Returns a Collection object of GuideQuestion objects filtered by service type, if any.
     */
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
     * Set the service type using a URL parameter.
     */
    public function setServiceTypeByUrl(Request $request)
    {
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

        return redirect('/guide/getting-started');
    }

    /**
     * Clear all session data and send the user to the first question in the guide.
     */
    public function hardReset(Request $request)
    {
        // Clear all session data
        $this->resetGuide($request);

        // Send the user to the first question
        return redirect('/guide');
    }

    /**
     * Clears all data from the session, which clears data from the guide.
     */
    public function resetGuide(Request $request)
    {
        $resetAll = stripos($request->path(), 'all') !== false;

        // In the event that we are
        $keysToKeep = [
            self::SERVICE_TYPE_PREFIX . 'selection',
            'userFirstName',
            'userLastName',
            'userEmail'
        ];

        $values = [];

        foreach ($keysToKeep as $key) {
            $values[$key] = session($key);
        }

        // Clear all of the session data
        session()->flush();

        Log::debug(__FUNCTION__ . '(); cleared all session data.');

        // Reset the number of reflections to the minimum
        session()->put(self::NUM_REFLECTIONS_PERSONS, env('MIN_NUM_REFLECTIONS_PERSONS', 2));

        // If we are clearing all of the session data, there is no need to restore anything
        if ($resetAll) {
            return;
        }

        // Restoring service type and user demographic data
        foreach ($values as $key => $value) {
            session()->put($key, $value);
        }
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
        if ($serviceType !== null && $nextQuestion !== null &&
        strcasecmp($nextQuestion->uri, 'selected-service') === 0) {
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
        // the current category, which takes the user to the appropriate first question
        if ($question === null || $allQuestions->where('id', $question->id)->first() === null) {
            // $allQuestions is all questions based on the current service type, if any
            return redirect($nextQuestionUri);
        }

        // Get a collection of all incomplete questions; this will be useful for the Summary page
        $incompleteQuestions = $this->incompleteQuestions($allQuestions);

        $isPreview = $request->is('*/preview');
        $isPdf = $request->is('*/pdf*');

        // Here is all data that is to be returned with the view
        $data = [
            'bible_version' => \App\Models\BibleVersions::where('acronymn', 'NRSV')->first(),
            'categories' => $allCategories,
            'currentServiceType' => $serviceType,
            'currentCategory' => $category,
            'currentQuestion' => $question,
            'currentQuestionFields' => $question->guideQuestionFields()->get(),
            'nextCategory' => $nextCategory,
            'nextQuestion' => $nextQuestion,
            'nextQuestionUri' => $nextQuestionUri,
            'isUserIsDeceased' => strcasecmp(\App\Models\UserType::where('title', 'like', '%self%')->first()->id, old('userIsDeceased', session('userIsDeceased'))) === 0,
            'incompleteQuestions' => $incompleteQuestions,
            // Removes the header, footer, navigation, and other extra elements on the page
            'isPreview' => $isPreview || $isPdf,
            'submissionComplete' => $serviceType !== null && count($incompleteQuestions) === 0
        ];

        // Show a PDF in the browser if requested for the current guide question
        // This is most helpful for the summary
        if ($isPdf && !$isPreview) {
            Log::debug(__FUNCTION__ . '(); requesting PDF for /guide/' . $category->uri . '/' . $question->uri . '...');
            PDF::setOptions(['dpi' => 150, 'isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif']);
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('guide', $data);
            // To stream the PDF data is to show the PDF in the browser
            return $pdf->stream();
        }

        // The values included here will be available across all blade templates for /guide pages.
        // If $isPreview is true, then only the HTML for the guide question is visible
        return view(
            'guide',
            $data
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
        Request $request,
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

        // Clear all session data except demographic data
        $this->resetGuide($request);
    }

    /**
     * Replacement for store() that advances the guide forward or stays on the same page as needed.
     */
    public function advance(Request $request, \App\Models\GuideCategory $category, \App\Models\GuideQuestion $question = NULL) {

        // Get current selected service type
        $serviceType = self::getSelectedServiceType();

        // Get all questions based on current selected service type (if none, get all questions)
        $allQuestions = self::getQuestionsByServiceType($serviceType);

        // Default to the 1st question of the current category if the question is null;
        // this happens when a category is specified but not a question in the URL
        // By using $allQuestions, we avoid a database call and also calling an item that's not
        // a part of the given service
        if ($question === null) {
            // $question = \App\Models\GuideQuestion::where('guide_category_id', $category->id)->where('item_order', 1)->first();
            $question = $allQuestions->where('guide_category_id', $category->id)->first();
        }

        // Get the next question based on the current question
        $nextQuestion = $this->getNextGuideQuestion2($allQuestions, $category, $question, $serviceType);

        // Get the category from the next question
        $nextCategory = $nextQuestion ? $nextQuestion->guideCategory()->first() : null;

        // Get the URI from the next category and question
        $nextQuestionUri = $nextQuestion ? '/guide/' . $nextCategory->uri . '/' . $nextQuestion->uri : null;

        Log::debug(__FUNCTION__ . '(); validation succeeded.');

        // If the next-page input is nothing, then stay on the current page
        Log::debug(__FUNCTION__ . '(); current request path: ' . $request->path());
        if (!$request->has('next-page') || !$request->input('next-page')) {
            $nextQuestionUri = $request->path();
            Log::debug(__FUNCTION__ . '(); staying on page ' . $nextQuestionUri);
        } else {
            Log::debug(__FUNCTION__ . '(); advancing to page ' . $nextQuestionUri);
        }

        // If the user requested an increase in the number of people to provide reflections, then
        // increase the number
        $this->increaseReflectionsPersons($request, $question);

         // Now that we figured out the next possible question, now attempt to validate the page
         Log::debug(__FUNCTION__ . '(); about to validate the page...');
         // Validate and store the form submission; if validation fails, then an exception is thrown
         // and the code never progresses past this point
         $validated = $this->validatePage($request, $question);

        // If the next question is the summary, then set a session variable
        $this->markSubmissionComplete($nextCategory, $nextQuestion);

        // If the current question is the very first one, then clear everything except the service type
        $this->clearAllSessionData($request, $category, $question, $serviceType);

        // Save all data to the session
        self::putAllInputToSession($request);

        return redirect($nextQuestionUri)->withInput();
    }

    /**
     * Increase the number of persons that can give reflections by 1.
     */
    private function increaseReflectionsPersons(
        Request $request,
        \App\Models\GuideQuestion $question
    ) {
        // Stop here if the question is not the reflections question
        if (strcasecmp($question->uri, 'reflections') !== 0) {
            Log::debug(__FUNCTION__ . '(); this is not the reflections question, stopping...');
            return;
        }

        // Check and make sure there are not more than the maximum number of reflections
        $numReflections = intval(session(self::NUM_REFLECTIONS_PERSONS));
        $maxReflections = intval(env('MAX_NUM_REFLECTIONS_PERSONS'));

        if ($numReflections >= $maxReflections) {
            session()->put(self::NUM_REFLECTIONS_PERSONS, $maxReflections);
            Log::debug(__FUNCTION__ . '(); already at the maximum number of persons, stopping...');
            return;
        }

        // Stop here if the user did not request an increase in reflections
        if (!$request->has('increaseReflections')) {
            Log::debug(__FUNCTION__ . '(); request did not include the increaseReflections hidden input, stopping...');
            return;
        }

        // Increase the number of reflections by 1
        session()->put(self::NUM_REFLECTIONS_PERSONS, $numReflections + 1);
        Log::debug(__FUNCTION__ . '(); number of reflections persons increased to ' .
        session(self::NUM_REFLECTIONS_PERSONS));
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
     * Returns a Collection object containing questions that are incomplete. These
     * questions are then highlighted red on the Summary page.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function incompleteQuestions(
        \Illuminate\Database\Eloquent\Collection $questions,
        \App\Models\ServiceType $serviceType = NULL
    ) {
        $incomplete = [];

        // 1. Using all questions based on the service type, check the required fields in the session
        // If any are missing, then return false. Skip any that are "requireIf," "requireUnless,"
        // or any other "special" require types since they are conditional.

        foreach ($questions as $question) {

            Log::debug(__FUNCTION__ . '(); question title: ' . $question->title);

            // 1. Get the validation rules for the current question.
            // https://laravel.com/docs/9.x/collections#method-mapwithkeys
            // all() is required to get the underlying array; otherwise, a Collection object is returned
            // https://laravel.com/docs/9.x/collections#method-all

            // If the question is optional and the user chose not to include it, then no need to
            // validate any of the items
            if ($question->optional_html_id && strcasecmp(session($question->optional_html_id), 'no') === 0) {
                Log::debug(__FUNCTION__ . '(); the question ' . $question->title . ' is optional and was declined. skipping...');
                continue;
            }

            // Get a list of all validations with using standard rule "required"
            $validations = $question->guideQuestionFields()->where('required_type', 'required')->get();

            // 2. Loop through validations for the current question
            foreach ($validations as $validation) {

                // 2. If the html_id is not in the session or is empty, then return false
                $value = session($validation->html_id);

                if (!session()->has($validation->html_id) || !$value) {
                    Log::debug(__FUNCTION__ . '(); submission validation - required value for ' .
                    'question ' . $question->title . ' missing: ' . $validation->label);
                    $incomplete[] = $question;
                    break;
                }
            }
        }

        return collect($incomplete);
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
        })->filter(function ($value, $key) use ($request) {
            // $key is the ID of the input field, like 'dateDeath'; keeps the validation rule if
            // the field is in the form input of the request
            return $request->has($key);
        })
        ->all();

        // To properly specify custom messages for different validation rules, you will need to use
        // the column "required_type" to do so
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
