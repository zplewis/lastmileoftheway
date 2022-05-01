<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\GuideQuestion;
use \App\Models\GuideCategory;

class GuideQuestionFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demographicsId = GuideCategory::where('title', 'Demographics')->first()->id;
        $personalizeServiceId = GuideCategory::where('uri', 'personalize-service')->first()->id;
        $serviceTypeId = GuideCategory::where('uri', 'service-type')->first()->id;

        // https://laravel.com/docs/9.x/validation#available-validation-rules

        DB::table('guide_question_fields')->insert([
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'userFirstName',
                'label' => 'First name',
                'validation' => 'required|max:50',
                'validation_msg' => "Your first name is required.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'userLastName',
                'label' => 'Last name',
                'validation' => 'required|max:50',
                'validation_msg' => "Your last name is required.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'userEmail',
                'label' => 'Email address',
                'validation' => 'required|email',
                'validation_msg' => "Please enter a valid email address.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'userIsDeceased',
                'label' => 'Are you planning a service for yourself?',
                'validation' => 'required',
                'validation_msg' => "Please select whether you are planning this service for yourself or someone else.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'deceasedFirstName',
                'label' => 'Deceased First Name',
                'validation' => 'required_unless:userIsDeceased,2',
                'validation_msg' => "The first name of the deceased is required.",
                'required_type' => 'required_unless'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'deceasedLastName',
                'label' => 'Deceased Last Name',
                'validation' => 'required_unless:userIsDeceased,2',
                'validation_msg' => "The last name of the deceased is required.",
                'required_type' => 'required_unless'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'dates')->first()->id,
                'html_id' => 'dateBirth',
                'label' => 'Date of birth',
                'validation' => 'required|date:m/d/Y',
                'validation_msg' => "Date of birth is required.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'dates')->first()->id,
                'html_id' => 'dateDeath',
                'label' => 'Date of passing away',
                'validation' => 'required|date:m/d/Y',
                'validation_msg' => "Date of passing away is required.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'processional')->first()->id,
                'html_id' => 'hasProcessional',
                'label' => 'Include a Processional in this service',
                'validation' => 'required',
                'validation_msg' => "Please choose whether you want to include a processional in this service or not.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'call-to-worship')->first()->id,
                'html_id' => 'hasCallToWorship',
                'label' => 'Include Call to Worship in this service',
                'validation' => 'required',
                'validation_msg' => "Please choose whether you want to include this as part of the this service or not.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'call-to-worship')->first()->id,
                'html_id' => 'callToWorshipMinister',
                'label' => 'Officiating Minister',
                'validation' => 'required_unless:hasCallToWorship,no',
                'validation_msg' => "Please enter the minister in charge of this part of the service.",
                'required_type' => 'required_unless'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'invocation')->first()->id,
                'html_id' => 'invocationMinister',
                'label' => 'Invocation',
                'validation' => 'required',
                'validation_msg' => "Please enter the minister in charge of this part of the service.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'musical-selection-1')->first()->id,
                'html_id' => 'hasMusicalSelection1',
                'label' => 'Include an opening hymn in this service',
                'validation' => 'required',
                'validation_msg' => "Please choose whether you want to include this as part of the this service or not.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'musical-selection-1')->first()->id,
                'html_id' => 'songMinister1',
                'label' => 'Who is rendering the music?',
                'validation' => 'required_unless:hasMusicalSelection1,no',
                'validation_msg' => "The person or group responsible for rendering the music is required.",
                'required_type' => 'required_unless'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'musical-selection-1')->first()->id,
                'html_id' => 'songType1',
                'label' => 'Select a song type',
                'validation' => 'required_unless:songCustom1,null',
                'validation_msg' => "Please select a song type.",
                'required_type' => 'required_unless'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'musical-selection-1')->first()->id,
                'html_id' => 'song1',
                'label' => 'Select a song',
                'validation' => 'required_unless:songCustom1,null',
                'validation_msg' => "Please select a song.",
                'required_type' => 'required_unless'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'old-testament')->first()->id,
                'html_id' => 'oldTestamentReadingReader',
                'label' => 'Scripture reader',
                'validation' => 'required',
                'validation_msg' => "Please specify who will read the scripture.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'old-testament')->first()->id,
                'html_id' => 'oldTestamentReading',
                'label' => 'Select a reading',
                'validation' => 'required_without:oldTestamentReadingCustom',
                'validation_msg' => "Please select a scripture from the list.",
                'required_type' => 'required_without'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'old-testament')->first()->id,
                'html_id' => 'oldTestamentReadingCustom',
                'label' => 'Or, feel free to specify your own below:',
                'validation' => 'required_without:oldTestamentReading',
                'validation_msg' => "Please select a scripture above or specify your own in the textbox.",
                'required_type' => 'required_without'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'prayer-of-comfort')->first()->id,
                'html_id' => 'hasPrayerOfComfort',
                'label' => 'Include Prayer of Comfort in this service',
                'validation' => 'required',
                'validation_msg' => "Please choose whether you want to include this as part of the this service or not.",
                'required_type' => 'required'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $personalizeServiceId)
                ->where('uri', 'prayer-of-comfort')->first()->id,
                'html_id' => 'prayerOfComfortPerson',
                'label' => 'Prayer of Comfort',
                'validation' => 'required_unless:hasPrayerOfComfort,no',
                'validation_msg' => "Please enter the minister in charge of this part of the service.",
                'required_type' => 'required_unless'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $serviceTypeId)
                ->where('uri', 'selected-service')->first()->id,
                'html_id' => 'service-type-selection',
                'label' => null,
                'validation' => 'required',
                'validation_msg' => "Please select a service type.",
                'required_type' => 'required'
            ],
        ]);
    }
}
