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
        $customizeServiceId = GuideCategory::where('title', 'Customize Service')->first()->id;

        DB::table('guide_questions')->insert([
            [
                'guide_category_id' => $gettingStartedId,
                'title' => 'Take a Breath',
                'uri' => 'take-a-breath',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'order' => 1,
                'description' => 'The site will guide you through thinking about the different parts
                of the service. All fields are required unless otherwise indicated. If you ever need
                help, feel free to check our <a href="/resources/glossary" title="Glossary">
                glossary</a> or <a href="/resources/faqs" title="FAQs">FAQs</a>. Still have
                questions? Feel free to use <a href="/support" title="Support">the contact form</a>
                to more support.'
            ],
            [
                'guide_category_id' => $demograhpicsId,
                'title' => 'Your Name & Name of Deceased',
                'uri' => 'names',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'order' => 1,
                'description' => ''
            ],
            [
                'guide_category_id' => $demograhpicsId,
                'title' => 'Birth, Death, and Service Dates',
                'uri' => 'dates',
                'optional' => 'Include a <a href="/resources/glossary#viewing" title="Glossary -
                viewing" target="_blank">viewing</a> one hour prior to start of service',
                'optional_html_id' => 'hasViewing',
                'order' => 2,
                'description' => 'Include relevant dates about the deceased that may be included on a program.'
            ],
            [
                'guide_category_id' => $demograhpicsId,
                'title' => 'Venue Location',
                'uri' => 'venue',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'order' => 3,
                'description' => 'If known, specify the location of the service. The address will
                be validated with Google Maps to ensure it is accurate and can be found easily via
                GPS by traveling attendees. If the location is not known yet, that\'s okay.'
            ],
            [
                'guide_category_id' => $customizeServiceId,
                'title' => 'Service Type',
                'uri' => 'service-type',
                'optional' => NULL,
                'optional_html_id' => NULL,
                'order' => 1,
                'description' => 'If known, specify the location of the service. The address will
                be validated with Google Maps to ensure it is accurate and can be found easily via
                GPS by traveling attendees. If the location is not known yet, that\'s okay.'
            ],
            [
                'guide_category_id' => $customizeServiceId,
                'title' => 'Processional',
                'uri' => 'processional',
                'optional' => 'Include a Processional in this service',
                'optional_html_id' => 'hasProcessional',
                'order' => 2,
                'description' => Definitions::where('term', 'processional')->first()->full_text
            ],
        ]);
    }
}
