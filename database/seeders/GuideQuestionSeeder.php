<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\GuideCategory;
use \App\Models\Definitions;

class GuideQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gettingStartedId = GuideCategory::where('title', 'Getting Started')->first()->id;
        $demograhpicsId = GuideCategory::where('title', 'Demographics')->first()->id;
        $serviceTypeId = GuideCategory::where('uri', 'service-type')->first()->id;
        $personalizeServiceId = GuideCategory::where('uri', 'personalize-service')->first()->id;
        $nextStepsId = GuideCategory::where('title', 'Next Steps')->first()->id;

        DB::table('guide_questions')->insert([
            [
                'guide_category_id' => $gettingStartedId,
                'title' => 'Take a Breath',
                'uri' => 'take-a-breath',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 1,
                'description' => 'The site will guide you through thinking about the different parts
                of the service. All fields are required unless otherwise indicated. If you ever need
                to go back to a previous section, feel free to click any link in the sidebar on the
                left-hand side. Please note that this site does not create a <strong>program</strong>, but a liturgy (order of
                service) to help you plan the service and determine the people and details that
                are involved.<br /><br />If you ever need help, feel free to check our <a href="/resources/glossary" title="Glossary">
                glossary</a> or <a href="/resources/faqs" title="FAQs">FAQs</a>. At the end, you\'ll
                have the opportunity to submit feedback on your service planning experience.',
            ],
            [
                'guide_category_id' => $demograhpicsId,
                'title' => 'Your Name & Name of Deceased',
                'uri' => 'names',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 1,
                'description' => ''
            ],
            [
                'guide_category_id' => $demograhpicsId,
                'title' => 'Birth, Death, and Service Dates',
                'uri' => 'dates',
                'optional' => 'Include a <a href="/resources/glossary#viewing" title="Glossary -
                viewing" target="_blank">viewing</a> one hour prior to start of service',
                'optional_html_id' => 'hasViewing',
                'item_order' => 2,
                'description' => 'Include relevant dates about the deceased that may be included on a program.'
            ],
            [
                'guide_category_id' => $serviceTypeId,
                'title' => 'Venue Location',
                'uri' => 'venue',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 2,
                'description' => 'If known, specify the location of the service. The address will
                be validated with Google Maps to ensure it is accurate and can be found easily via
                GPS by traveling attendees. If the location is not known yet, that\'s okay.'
            ],
            [
                'guide_category_id' => $serviceTypeId,
                'title' => 'Select a Service',
                'uri' => 'select-a-service',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 1,
                'description' => 'Which type of service best suits your needs?'
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Processional',
                'uri' => 'processional',
                'optional' => 'Include a Processional in this service',
                'optional_html_id' => 'hasProcessional',
                'item_order' => 2,
                'description' => Definitions::where('term', 'processional')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Call to Worship',
                'uri' => 'call-to-worship',
                'optional' => 'Include Call to Worship to open the service',
                'optional_html_id' => 'hasCallToWorship',
                'item_order' => 3,
                'description' => 'The opening words of the service usually spoken by the officiating minister.'
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Invocation',
                'uri' => 'invocation',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 4,
                'description' => Definitions::where('term', 'invocation')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Opening Hymn',
                'uri' => 'musical-selection-1',
                'optional' => 'Include musical selection #1 in this service',
                'optional_html_id' => 'hasMusicalSelection1',
                'item_order' => 5,
                'description' => Definitions::where('term', 'hymn')->first()->full_text .
                ' While some examples are included below, feel free to select one not included
                here.'
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Old Testament Reading',
                'uri' => 'old-testament',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 6,
                'description' => Definitions::where('term', 'old testament scripture reading')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'New Testament Reading',
                'uri' => 'new-testament',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 7,
                'description' => Definitions::where('term', 'new testament scripture reading')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Prayer of Comfort',
                'uri' => 'prayer-of-comfort',
                'optional' => 'Include Prayer of Comfort in this service',
                'optional_html_id' => 'hasPrayerOfComfort',
                'item_order' => 8,
                'description' => Definitions::where('term', 'prayer of comfort')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Musical Selection #2',
                'uri' => 'musical-selection-2',
                'optional' => 'Include musical selection #2 in this service',
                'optional_html_id' => 'hasMusicalSelection2',
                'item_order' => 9,
                'description' => 'Some text explaining what this page is about, putting the user at ease.'
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Reflections (2 Minutes)',
                'uri' => 'reflections',
                'optional' => 'Include Reflections (2 Minutes) in this service',
                'optional_html_id' => 'hasReflections',
                'item_order' => 10,
                'description' => 'Some text explaining what this page is about, putting the user at ease.'
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Acknowledgements',
                'uri' => 'acknowledgements',
                'optional' => 'Include Acknowledgements in this service',
                'optional_html_id' => 'hasAcknowledgements',
                'item_order' => 11,
                'description' => Definitions::where('term', 'acknowledgements')->first()->short_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Musical Selection #3',
                'uri' => 'musical-selection-3',
                'optional' => 'Include musical selection #3 in this service',
                'optional_html_id' => 'hasMusicalSelection3',
                'item_order' => 12,
                'description' => 'Some text explaining what this page is about, putting the user at ease.'
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Sermon / Eulogy',
                'uri' => 'eulogy',
                'optional' => 'Include Sermon / Eulogy in this service',
                'optional_html_id' => 'hasEulogy',
                'item_order' => 13,
                'description' => Definitions::where('term', 'eulogy')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Committal & Benediction',
                'uri' => 'committal',
                'optional' => NULL,
                'optional_html_id' => 'hasCommittal',
                'item_order' => 16,
                'description' => Definitions::where('term', 'committal')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Mortician\'s Brief',
                'uri' => 'mortician',
                'optional' => 'Include Mortician\'s Brief in this service',
                'optional_html_id' => 'hasMorticiansBrief',
                'item_order' => 14,
                'description' => Definitions::where('term', 'mortician\'s brief')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Recessional',
                'uri' => 'recessional',
                'optional' => 'Include Recessional in this service',
                'optional_html_id' => 'hasRecessional',
                'item_order' => 15,
                'description' => Definitions::where('term', 'recessional')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Burial',
                'uri' => 'burial',
                'optional' => 'Include Burial in this service',
                'optional_html_id' => 'hasBurial',
                'item_order' => 17,
                'description' => Definitions::where('term', 'committal')->first()->full_text
            ],
            [
                'guide_category_id' => $personalizeServiceId,
                'title' => 'Benediction',
                'uri' => 'benediction',
                'optional' => 'Include Benediction in this service',
                'optional_html_id' => 'hasBenediction',
                'item_order' => 18,
                'description' => Definitions::where('term', 'benediction')->first()->full_text
            ],
            [
                'guide_category_id' => $nextStepsId,
                'title' => 'Summary',
                'uri' => 'summary',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 1,
                'description' => 'Please review your selections. Click Edit for any section to
                modify that part of the service.'
            ],
            [
                'guide_category_id' => $nextStepsId,
                'title' => 'Additional Questions',
                'uri' => 'questions',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 2,
                'description' => 'Here are some more questions to ask your question or funeral home.'
            ],
            [
                'guide_category_id' => $nextStepsId,
                'title' => 'Submit Feedback',
                'uri' => 'feedback',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'item_order' => 3,
                'description' => 'Was this site helpful to you? What did this process do well? What
                could be better? Please let us know using the feedback form below.'
            ],

        ]);
    }
}
