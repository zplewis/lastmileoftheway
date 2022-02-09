<?php

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

Route::prefix('guide')->group(function() {

    Route::get('', function () {
        return redirect('guide/getting-started');
    });

    $sections = [
        'getting-started' => [
            '' => [
                'description' => 'Take a Breath',
                'next' => 'demographics'
            ]

        ],
        'demographics' => [
            '' => [
                'description' => 'Your Name, Name of Deceased',
                'lead' => 'Additional text to explain what this page is about',
                'next' => 'demographics.dates'
            ],
            'dates' => [
                'description' => 'Birth, Death, and Service Dates',
                'next' => 'demographics.venue'
            ],
            'venue' => [
                'description' => 'Venue Location',
                'next' => 'customize-service'
            ]
        ],
        // 'customize-service' => [
        //     '' => 'Call to Worship',
        //     'invocation' => 'Invocation',
        //     'hymn' => 'Hymn',
        //     'old-testament' => 'Old Testament Reading',
        //     'new-testament' => 'New Testament Reading',
        //     'prayer-of-comfort' => 'Prayer of Comfort',
        //     'musical-selection' => 'Musical Selection',
        //     'reflections' => 'Two Minute Reflections',
        //     'acknowledgements' => 'Acknowledgements',
        //     'musical-selection-2' => 'Musical Selection #2',
        //     'eulogy' => 'Eulogy / Words of Comfort',
        //     'mortician' => 'Mortician\'s Brief',
        //     'burial' => 'Burial'
        // ],
        // 'next-steps' => [
        //     '' => 'Summary',
        //     'questions' => 'Additional Questions',
        //     'feedback' => 'Feedback Survey'
        // ]
    ];

    foreach ($sections as $section => $pages) {
        foreach ($pages as $page => $info) {

            Route::get($section . '/' . $page, function() use ($section, $page, $info, $sections) {

                $fullPage = $section;
                if ($page) {
                    $fullPage .= '/' . $page;
                }

                $viewName = strtr($fullPage, '/', '.');

                return view(
                    'guide',
                    [
                        'section' => $section,
                        'page' => strtr($fullPage, '/', '.'),
                        'pageDesc' => Arr::get($info, 'description'),
                        'sections' => $sections,
                        'lead' => Arr::get($info, 'lead')
                    ]
                );
            });

            Route::post($section . '/' . $page, [SubmissionController::class, 'store']);
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
