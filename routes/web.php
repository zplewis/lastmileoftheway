<?php

use Illuminate\Support\Facades\Route;
use \App\Models\FAQCategories;
use \App\Models\Definitions;

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

Route::prefix('guide')->group(function() {
    Route::get('/', function () {
        return view('guide');
    });

    Route::get('/demographics', function () {
        return view('guide2');
    });
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
                'old' => Scriptures::whereRelation('')
            ]
        );
    });
});
