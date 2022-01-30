<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\FAQQuestions;

class FAQAnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('f_a_q_answers')->insert([
            [
                'f_a_q_questions_id' => FAQQuestions::where(
                    'description',
                    'How many people can attend in-person?'
                )->first()->id,
                'short_text' => '',
                'full_text' => "If there are social distancing concerns, the number of attendees
                 may be limited."
            ],
            [
                'f_a_q_questions_id' => FAQQuestions::where(
                    'description',
                    "Will personal protective equipment (masks, sanitizer) be provided?"
                )->first()->id,
                'short_text' => '',
                'full_text' => "Make sure to check who is responsible for providing this equipment."
            ],
            [
                'f_a_q_questions_id' => FAQQuestions::where(
                    'description',
                    "Are temperature checks required for entry?"
                )->first()->id,
                'short_text' => '',
                'full_text' => "Depending on the protocols in the state, temperature checks may be required."
            ],
            [
                'f_a_q_questions_id' => FAQQuestions::where(
                    'description',
                    "Is video conferencing available for those who cannot attend in-person?"
                )->first()->id,
                'short_text' => '',
                'full_text' => "If the venue does not provide it, see if it's possible to use your
                own equipment like your phone or camera once you have permission."
            ],
            [
                'f_a_q_questions_id' => FAQQuestions::where(
                    'description',
                    'What video platforms are good for using at a funeral?'
                )->first()->id,
                'short_text' => '',
                'full_text' => "Facebook, Zoom, YouTube"
            ],
        ]);
    }
}
