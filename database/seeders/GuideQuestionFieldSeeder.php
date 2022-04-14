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
                'validation' => 'required_unless:userIsDeceased,null',
                'validation_msg' => "The first name of the deceased is required.",
                'required_type' => 'required_unless'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'deceasedLastName',
                'label' => 'Deceased Last Name',
                'validation' => 'required_unless:userIsDeceased,null',
                'validation_msg' => "The last name of the deceased is required.",
                'required_type' => 'required_unless'
            ],
        ]);
    }
}
