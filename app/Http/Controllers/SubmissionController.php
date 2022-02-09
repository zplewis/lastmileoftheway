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

        Log::debug('request->path: ' . $request->path());

        // If a failure occurred, return to the current request path. Otherwise,
        // go to the next one (if applicable, the last page won't have a next
        // page).
        return redirect($request->input('next-page', $request->path()))->withInput();
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
