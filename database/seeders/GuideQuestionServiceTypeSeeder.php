<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\GuideQuestion;
use \App\Models\ServiceType;
use \App\Models\GuideCategory;

class GuideQuestionServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // It seems like it would be faster to attach all questions and then
        // only detach the ones that don't apply...
        $allQuestions = GuideQuestion::all();
        $allServiceTypes = ServiceType::all();

        foreach ($allQuestions as $question) {
            $question->serviceTypes()->attach($allServiceTypes);
        }

    }
}
