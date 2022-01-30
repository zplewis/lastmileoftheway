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
            ]
        ]);
    }
}
