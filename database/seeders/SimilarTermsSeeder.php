<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'description' => 'Social distancing'
            ],
            [
                'description' => 'Video conferencing'
            ]
        ]);
    }
}
