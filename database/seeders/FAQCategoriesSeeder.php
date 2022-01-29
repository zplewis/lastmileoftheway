<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('f_a_q_categories')->insert([
            [
                'description' => 'Social distancing'
            ],
            [
                'description' => 'Video conferencing'
            ]
        ]);
    }
}
