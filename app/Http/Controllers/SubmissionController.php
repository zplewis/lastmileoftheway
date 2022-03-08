<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class SubmissionController extends Controller
{

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
        $title = ucwords(str_replace('service-type-', '', $value));

        Log::debug(__FUNCTION__ . '(); dervived service type title: ' . $title);

        return \App\Models\ServiceType::where('title', $title)->first();
    }

    /**
     * Retrieves questions for a given category based on whether a service type has been selected
     * or not.
     */
    public static function getQuestionsByCategoryByServiceType(
        \App\Models\GuideCategory $category,
        \App\Models\ServiceType $serviceType = NULL
    ) {
        $questions = $category->guideQuestions()->orderBy('item_order')->get();

        if (!$serviceType) {
            return $questions;
        }

        // Brute force way to do it; I'm pretty sure there is a better way.
        $filtered = collect();

        foreach ($questions as $question) {

            $found = $question->serviceTypes()->find($serviceType->id);

            // Log::debug(__FUNCTION__ . '(); question text: ' . $question->title);
            // Log::debug(__FUNCTION__ . '(); service types for question (#1): ', $test);

            if (!$found) {
                continue;
            }

            $filtered->push($question);
        }

        return $filtered;
    }

    /**
     * Store answers to the current question to the session. When on the final page in next steps,
     * save the answers to the database.
     */
    public function store(Request $request)
    {
        Log::debug(__FUNCTION__ . 'about to validate the page...');
        // Validate and store the form submission.
        $validated = $this->validatePage($request);

        Log::debug(__FUNCTION__ . 'request->path(): ' . $request->path());

        // Reflash all data
        // $request->session()->reflash();

        $this->putAllInputToSession($request);
        Log::debug(__FUNCTION__ . '(); just reflashed input to the session...');

        // If a failure occurred, return to the current request path. Otherwise,
        // go to the next one (if applicable, the last page won't have a next
        // page). The path for the next page comes from the 'next-page' input
        $redirectPath = $request->input('next-page', null);
        if (!$redirectPath) {
            $redirectPath = $request->path();
        }

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
                Log::debug(__FUNCTION__ . '(); skipping the category: ' . $sidebarCategory->title);
                continue;
            }

            Log::debug(__FUNCTION__ . '(); category: ' . $sidebarCategory->title);

            $questions = $this::getQuestionsByCategoryByServiceType(
                $sidebarCategory,
                $serviceType
            );

            foreach ($questions as $sidebarQuestion) {
                if ($found) {
                    Log::debug(__FUNCTION__ . '(); found the next question: ' . $sidebarQuestion->title);
                    return $sidebarQuestion;
                }

                if ($sidebarQuestion->id === $question->id) {
                    $found = true;
                    Log::debug(__FUNCTION__ . '(); found the current question!');
                }
            }
        }

        return NULL;
    }

    /**
     *
     */
    public function load(
        Request $request,
        \Illuminate\Database\Eloquent\Collection $categories,
        \App\Models\GuideCategory $category,
        \App\Models\GuideQuestion $question
    ) {

        Log::debug(__FUNCTION__ . '(); question: ' . $question->title);

        // Discover the next guide question
        $nextQuestion = $this->getNextGuideQuestion(
            $categories,
            $category,
            $question
        );

        if ($nextQuestion) {
            $nextCategory = $nextQuestion->guideCategory()->first();
            Log::debug(__FUNCTION__ . '(); next question category: ' . $nextCategory->title);
            Log::debug(__FUNCTION__ . '(); next question question: ' . $nextQuestion->title);
            Log::debug(__FUNCTION__ . '(); next uri: ' . 'guide/' . $nextCategory->uri . '/' . $nextQuestion->uri);
        }

        return view(
            'guide',
            [
                'categories' => $categories,
                'currentCategory' => $category,
                'currentQuestion' => $question,
                'nextQuestion' => $nextQuestion,
                'nextQuestionUri' => ($nextQuestion !== NULL ? $nextQuestion->pageUri() : ''),
                'currentServiceType' => $this::getSelectedServiceType()
            ]
        );
    }

    private function putAllInputToSession(Request $request)
    {
        // https://laravel.com/docs/8.x/requests#retrieving-an-input-value

        Log::debug(__FUNCTION__ . '(); all input: ', $request->all());

        foreach ($request->input() as $key => $value) {
            if (strcasecmp($key, 'next-page') === 0) {
                continue;
            }
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
     */
    private function validatePage(Request $request)
    {
        $path = $request->path();

        $validated = null;
        // https://laravel.com/docs/8.x/requests#retrieving-the-request-path
        // All validation rules:
        // https://laravel.com/docs/8.x/validation#available-validation-rules
        switch($path)
        {
            case 'guide/demographics':
                Log::debug(__FUNCTION__ . '(); made it to case "' . $path . '"');
                // This returns an array, not an object
                $validated = $request->validate([
                    // 'userFirstName' => 'required|max:50',
                    // 'userLastName' => 'required|max:50',
                    // 'userEmail' => 'required|email'
                ]);
                break;
        }

        return $validated;
    }
}
