<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use \App\Models\FAQCategories;
use \App\Models\Definitions;
use App\Models\GuideCategory;
use \App\Models\Scriptures;
use \App\Models\SongType;
use \App\Models\Song;
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
    return view('faqs', ['categories' => \App\Models\FAQCategories::orderBy('description')->get()]);
});

Route::permanentRedirect('/glossary', '/resources/glossary');

Route::get('/support', function () {
    return view('support');
});

Route::get('/guide', function(\Illuminate\Http\Request $request) {

    $path = '/guide/getting-started';

    // If a service is passed to /guide and it is a valid service type, then
    // go ahead and set the service type
    if ($request->has('service')) {
        $serviceType = \App\Models\ServiceType::where('title', ucwords($request->input('service')))->first();

        if ($serviceType !== null) {
            // Save the service type to the session
            $request->merge([\App\Http\Controllers\SubmissionController::SERVICE_TYPE_PREFIX . 'selection' => \App\Http\Controllers\SubmissionController::SERVICE_TYPE_PREFIX . strtolower($serviceType->title)]);
            \App\Http\Controllers\SubmissionController::putAllInputToSession($request);
        }
    }

    return redirect($path);
});

// Put this code in a static method so that if problems occur, the fix is to
// 1. Comment out this method
// 2. Run all migrations and seeders
// 3. Uncomment this method
// 4. Run all migrations and seeders again
// \App\Http\Controllers\SubmissionController::generateRoutes();

// This worked due to explicit binding, since implicit binding didn't seem to do it.
Route::controller(SubmissionController::class)->group(function () {
    Route::get('/guide/{guidecategory}', 'implicitLoad');
    Route::get('/guide/{guidecategory}/{guidequestion}', 'implicitLoad');
    Route::post('/guide/{guidecategory}', 'advance');
    Route::post('/guide/{guidecategory}/{guidequestion}', 'advance');
});



Route::prefix('resources')->group(function() {
    Route::match(['get', 'post'], '/songs', function (\Illuminate\Http\Request $request) {

        Log::debug(__FUNCTION__ . '(); songs method: ' . $request->method());

        if ($request->isMethod('post')) {
            \App\Http\Controllers\SubmissionController::putAllInputToSession($request);
        }

        return view(
            'resources.songs',
            [
                'songTypes' =>  \App\Models\SongType::orderBy('name')->get(),
                'songs' => \App\Models\Song::orderBy('song_type_id')->orderBy('name')->get()
            ]
        );
    });

    Route::get('/glossary', function () {
        return view(
            'resources.glossary',
            [
                // https://stackoverflow.com/a/431930/1620794
                'categories' => range('A', 'Z')
            ]
        );
    });
    Route::get('/bible-readings', function () {

        // Version to use for readings
        $nrsv = \App\Models\BibleVersions::where('acronymn', 'NRSV')->first();

        return view(
            'resources.readings',
            [
                'testaments' => \App\Models\Testament::orderBy('name', 'desc')->get(),
                'bible_version' => $nrsv

            ]
        );
    });


});
