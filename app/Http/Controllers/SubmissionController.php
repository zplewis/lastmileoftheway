<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    /**
     * Store a new submission
     */
    public function store(Request $request)
    {
        Log::debug('about to validate the page...');
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

    public function load(Request $request)
    {

    }

    private function putAllInputToSession(Request $request)
    {
        // https://laravel.com/docs/8.x/requests#retrieving-an-input-value

        foreach ($request->input() as $key => $value) {
            if (strcasecmp($key, 'next-page') === 0) {
                continue;
            }
            $request->session()->put($key, $value);
        }

        // Just in case, forget 'next-page' if it's there, as that needs to be fresh every time
        $request->session()->forget('next-page');

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
