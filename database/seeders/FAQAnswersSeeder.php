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
            [
                'f_a_q_questions_id' => FAQQuestions::where(
                    'description',
                    'What can I expect from Reeder Memorial Baptist Church?'
                )->first()->id,
                'short_text' => '',
                'full_text' => "When a member passes, the church does not charge anything for a
                funeral or memorial service. Our building is open at limited capacity (200 people
                in the sanctuary); however, we do have streaming options. The pastor, musicians,
                media coordinator, and volunteers are happy to assist anyway we can. Currently, we
                do not host repasts in our Fellowship Hall, but we do provide food at a place of
                your choosing at no costs. For more details, a policy and planning worksheet is
                available on the church's website (<a href=\"https://reederministries.org\"
                target=\"_blank\">https://reederministries.org</a>)."
            ],
            [
                'f_a_q_questions_id' => FAQQuestions::where(
                    'description',
                    'Does the church design and/or print programs for the service?'
                )->first()->id,
                'short_text' => '',
                'full_text' => "Not generally. This is something you can either do yourself or have
                the funeral home take care of (at a fee). Either way, it is imperative to have
                conversation with the pastor or a representative from the church before going to
                print."
            ],
            [
                'f_a_q_questions_id' => FAQQuestions::where(
                    'description',
                    'Can clergy from outside to Reeder Memorial Baptist Church participate on the program?'
                )->first()->id,
                'short_text' => '',
                'full_text' => "Yes, however, particulars need to be discussed with Pastor Farrow.
                This is also the case when it comes to musical guests. "
            ],
        ]);
    }
}
