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

        DB::table('guide_question_fields')->insert([
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'userFirstName',
                'label' => 'First name',
                'validation' => 'required|max:50'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'userLastName',
                'label' => 'Last name',
                'validation' => 'required|max:50'
            ],
            [
                'guide_question_id' => GuideQuestion::where('guide_category_id', $demographicsId)
                ->where('uri', 'names')->first()->id,
                'html_id' => 'userEmail',
                'label' => 'Email address',
                'validation' => 'required|email'
            ],
        ]);
    }
}
