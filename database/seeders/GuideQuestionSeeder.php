<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\GuideCategory;

class GuideQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gettingStartedId = GuideCategory::where('title', 'Getting Started')->first()->id;

        DB::table('guide_questions')->insert([
            [
                'guide_category_id' => $gettingStartedId,
                'title' => 'Take a Breath',
                'uri' => 'take-a-breath',
                'optional' => false,
                'order' => 1
            ],
        ]);
    }
}
