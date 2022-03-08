<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use \App\Models\FAQCategories;
use \App\Models\Definitions;
use \App\Models\Scriptures;
use Illuminate\Support\Facades\Log;
use \App\Http\Controllers\SubmissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/faqs', function () {
    return view('faqs', ['categories' => FAQCategories::orderBy('description')->get()]);
});

Route::permanentRedirect('/glossary', '/resources/glossary');

Route::get('/support', function () {
    return view('support');
});

// Put this code in a static method so that if problems occur, the fix is to
// 1. Comment out this method
// 2. Run all migrations and seeders
// 3. Uncomment this method
// 4. Run all migrations and seeders again
// SubmissionController::generateRoutes();
Route::prefix('guide')->group(function() {

    $serviceType = SubmissionController::getSelectedServiceType();

    Log::debug(__FUNCTION__ . '(); current service type: ' . ($serviceType ? $serviceType->title : NULL));

    $categories = \App\Models\GuideCategory::orderBy('item_order')->get();

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
            Route::permanentRedirect('', $category->uri . '/');
        }

        // For each question type, create a get and post route
        foreach ($questions as $question) {
            $path = $category->uri . '/' . $question->uri;
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
                Route::permanentRedirect($category->uri . '/', $path);
            }

            Route::post($path, [SubmissionController::class, 'store']);
        }
    }
});


Route::prefix('resources')->group(function() {
    Route::get('/songs', function () {
        return view('resources.songs');
    });
    Route::get('/glossary', function () {
        return view(
            'resources.glossary',
            [
                // https://stackoverflow.com/a/431930/1620794
                'categories' => range('A', 'Z'),
                'definitions' => Definitions::orderBy('term')->get()
            ]
        );
    });
    Route::get('/bible-readings', function () {
        return view(
            'resources.readings',
            [
                'old' => []
            ]
        );
    });
});
