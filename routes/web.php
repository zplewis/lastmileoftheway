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
                'description' => 'Your Name &amp; Name of Deceased',
                'lead' => 'Additional optional text to explain what this page is about',
                'next' => 'demographics/dates'
            ],
            'dates' => [
                'description' => 'Birth, Death, and Service Dates',
                'lead' => 'Include relevant dates about the deceased that may be included on a program.',
                'next' => 'demographics/venue'
            ],
            'venue' => [
                'description' => 'Venue Location',
                'lead' => 'If known, specify the location of the service. The address will be validated with Google Maps to ensure it is accurate and can be found easily via GPS by traveling attendees. If the location is not known yet, that\'s okay.',
                'next' => 'customize-service'
            ]
        ],
        'customize-service' => [
            '' => [
                'description' => 'Call to Worship',
                'lead' => 'The opening words of the service usually spoken by the officiating minister.',
                'next' => 'customize-service/invocation'
            ],
            'invocation' => [
                'description' => 'Invocation',
                'lead' => 'The opening prayer. A number of prayers will be prayed throughout the service, each with a unique purpose. The purpose of the invocation is to acknowledge and affirm the Lord\'s presence (Matthew 18:20), and to ask the Lord\'s blessing upon all the happenings of the day. Though much planning and thought has gone into the service, still we yield to the superintending movement of the Holy Spirit.',
                'next' => 'customize-service/hymn'
            ],
            'hymn' => [
                'description' => 'Hymn',
                'lead' => 'A selection from the Church\'s hymnal. Songs like "Amazing Grace," "It is Well with My Soul," "Great is Thy Faithfulness," or "Come, Ye Disconsolate" are all examples of traditional songs sung by the Christian community that contain inspiring, well-developed statements of faith and hope. While some examples are included below, feel free to select one not included here.',
                'next' => 'customize-service/old-testament'
            ],
        ]
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
                        'lead' => Arr::get($info, 'lead'),
                        'next' => Arr::get($info, 'next')
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
