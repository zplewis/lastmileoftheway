<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Definitions;

class SimilarTermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('similar_terms')->insert([
            [
                'definitions_id' => Definitions::where('term','eulogy')->first()->id,
                'similar_id' => Definitions::where('term','words of comfort')->first()->id
            ],
            [
                'definitions_id' => Definitions::where('term','words of comfort')->first()->id,
                'similar_id' => Definitions::where('term','eulogy')->first()->id

            ],
            [
                'definitions_id' => Definitions::where('term','wake')->first()->id,
                'similar_id' => Definitions::where('term','viewing')->first()->id

            ],
            [
                'definitions_id' => Definitions::where('term','viewing')->first()->id,
                'similar_id' => Definitions::where('term','wake')->first()->id

            ],
            [
                'definitions_id' => Definitions::where('term','eulogist')->first()->id,
                'similar_id' => Definitions::where('term','eulogy')->first()->id

            ]
        ]);
    }
}
