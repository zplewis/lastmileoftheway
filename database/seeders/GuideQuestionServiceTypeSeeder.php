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
        GuideQuestion::where('uri', 'processional')->first()->serviceTypes()->detach([$memorial->id, $graveside->id]);

        // Musical selection #3 is not used for graveside service
        ServiceType::where('title', 'Graveside')->first()->guideQuestions()->detach(GuideQuestion::where('uri', 'musical-selection-3')->first()->id);
        // Question about graveside service: are reflections not limited to two minutes?
        // Recommended selection type for musical selection #3 is solo

        // There is no committal for a memorial
        GuideQuestion::where('uri', 'committal')->first()->serviceTypes()->detach([$memorial->id]);

        // Keep benediction (solo, not coupled with committal) only for memorial
        GuideQuestion::where('uri', 'benediction')->first()->serviceTypes()->detach([$graveside->id, $funeral->id]);

        // There is no burial at a memorial or graveside
        GuideQuestion::where('uri', 'burial')->first()->serviceTypes()->detach([$memorial->id, $graveside->id]);

        // No recessional at graveside; it should come after mortician's brief
        GuideQuestion::where('uri', 'recessional')->first()->serviceTypes()->detach([$graveside->id]);

        // We now have "venue" and "venue and viewing" questions;
        // graveside and memorial only needs venue
        // funeral needs venue and viewing
        GuideQuestion::where('uri', 'venue-and-viewing')->first()->serviceTypes()->detach([$memorial->id, $graveside->id]);
        GuideQuestion::where('uri', 'venue')->first()->serviceTypes()->detach([$funeral->id]);


    }
}
