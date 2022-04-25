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
                ->where('uri', 'musical-selection-1')->first()->id,
                'html_id' => 'songMinister1',
                'label' => 'Who is rendering the music?',
                'validation' => 'required_unless:hasMusicalSelection1,yes',
                'validation_msg' => "The person or group responsible for rendering the music is required.",
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
