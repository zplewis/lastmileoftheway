<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use \App\Models\FAQCategories;
use \App\Models\FAQQuestions;

class FAQQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $social_distancing = FAQCategories::where('description', 'Social distancing')->first()->id;
        $video_conferencing = FAQCategories::where('description', 'Video conferencing')->first()->id;
        $venue_expectations = FAQCategories::where('description', 'Venue expectations')->first()->id;

        $categories = [
            $social_distancing => [
                'How many people can attend in-person?',
                'Will personal protective equipment (masks, sanitizer) be provided?',
                'Are temperature checks required for entry?',
                'Is video conferencing available for those who cannot attend in-person?'
            ],
            $video_conferencing => [
                'What video platforms are good for using at a funeral?'
            ],
            $venue_expectations => [
                'What can I expect from Reeder Memorial Baptist Church?',
                'Does the church design and/or print programs for the service?',
                'Can clergy from outside to Reeder Memorial Baptist Church participate on the program?'
            ]
        ];

        $data = [];

        foreach ($categories as $id => $questions) {
            foreach ($questions as $question) {
                $data[] = [
                    'f_a_q_categories_id' => $id,
                    'description' => $question
                ];
            }
        }

        DB::table('f_a_q_questions')->insert($data);
    }
}
