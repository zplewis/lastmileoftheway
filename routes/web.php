<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use \App\Models\FAQCategories;
use \App\Models\Definitions;
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
SubmissionController::generateRoutes();

// Route::redirect('/guide', '/guide/getting-started/take-a-breath');

Route::prefix('resources')->group(function() {
    Route::get('/songs', function () {
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
                'categories' => range('A', 'Z'),
                'definitions' => \App\Models\Definitions::orderBy('term')->get()
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
