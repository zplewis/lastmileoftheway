<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\GuideQuestion;
use \App\Models\ServiceType;

class GuideQuestionServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = GuideQuestion::where('uri', 'take-a-breath')->first();
        $types = ServiceType::all();

        $question->serviceTypes()->attach($types);
    }
}
