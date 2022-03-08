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

        $graveside = ServiceType::where('title', 'Graveside')->first();
        $funeral = ServiceType::where('title', 'Funeral')->first();
        $memorial = ServiceType::where('title', 'Memorial')->first();

        // Processional is funeral only
        $memorial->guideQuestions()->detach(GuideQuestion::where('uri', 'processional')->first()->id);
        $graveside->guideQuestions()->detach(GuideQuestion::where('uri', 'processional')->first()->id);

        // Musical selection #2 is not used for graveside service
        ServiceType::where('title', 'Graveside')->first()->guideQuestions()->detach(GuideQuestion::where('uri', 'musical-selection-2')->first()->id);
        // Question about graveside service: are reflections not limited to two minutes?
        // Recommended selection type for musical selection #3 is solo
        // There is no committal

    }
}
