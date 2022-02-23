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
                'next' => 'customize-service/service-type'
            ]
        ],
        'customize-service' => [
            'service-type' => [
                'description' => 'Service Type',
                'lead' => 'Which type of service best suits your needs?',
                'next' => 'customize-service'
            ],
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
            'old-testament' => [
                'description' => 'Old Testament Reading',
                'lead' => 'A reading taken from one of the 39 books that comprise what Christians call the Old Testament. Central to any worship service is the reading of Scripture. In the Scripture, we not only find words about God and words directed to God, but we also find words from God addressed to us. Scriptures are both informational in nature and formational in purpose. Hearing the word of God shapes us, gives meaning to the service, brings perspective to pain, and reminds us that though tragedy has a way of hiding the face of God, God is present and continues to speak.',
                'next' => 'customize-service/new-testament'
            ],
            'new-testament' =>  [
                'description' => 'New Testament Reading',
                'lead' => 'A reading taken from one of the 27 books that comprise what Christians call the New Testament. Central to any worship service is the reading of Scripture. In the Scripture, we not only find words about God and words directed to God, but we also find words from God addressed to us. Scriptures are both informational in nature and formational in purpose. Hearing the word of God shapes us, gives meaning to the service, brings perspective to pain, and reminds us that though tragedy has a way of hiding the face of God, God is present and continues to speak.',
                'next' => 'customize-service/prayer-of-comfort'
            ],
            'prayer-of-comfort' =>  [
                'description' => 'Prayer of Comfort',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => 'customize-service/musical-selection'
            ],
            'musical-selection' =>  [
                'description' => 'Musical Selection',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => 'customize-service/reflections'
            ],
            'reflections' =>  [
                'description' => 'Reflections (2 minutes)',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => 'customize-service/acknowledgements'
            ],
            'acknowledgements' =>  [
                'description' => 'Acknowledgements',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => 'customize-service/musical-selection-2'
            ],
            'musical-selection-2' =>  [
                'description' => 'Musical Selection',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => 'customize-service/eulogy'
            ],
            'eulogy' =>  [
                'description' => 'Sermon',
                'lead' => 'A sermonette given at the funeral or memorial service. The eulogy is the part of the service where the pastor speaks a good word on behalf of the dead; however, in some cases, the pastor did not know the deceased personally. Consequently, "words of comfort" are substituted for the eulogy. Because the pastor has no firsthand knowledge of the deceased, the pastor will focus more on those left to mourn the passing of the deceased, reminding them that "The Lord is near to the brokenhearted, and saves the crushed in spirit" (Ps. 34:18).',
                'next' => 'customize-service/mortician'
            ],
            'mortician' => [
                'description' => 'Mortician\'s Brief',
                'lead' => 'At the end of the funeral, the mortician(s) will come forward to offer remarks, give instructions for exiting the building, and for the procession to the cemetery. Depending on the funeral home, they will also use this moment to present a keepsake or memento on behalf of the funeral home.',
                'next' => 'customize-service/burial'
            ],
            'burial' => [
                'description' => 'Burial',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => 'next-steps'
            ],
        ],
        'next-steps' => [
            '' => [
                'description' => 'Summary',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => 'next-steps/questions'
            ],
            'questions' => [
                'description' => 'Additional Questions',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => 'next-steps/feedback'
            ],
            'feedback' => [
                'description' => 'Feedback Survey',
                'lead' => 'Some text explaining what this page is about, putting the user at ease.',
                'next' => null
            ],
        ]
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
