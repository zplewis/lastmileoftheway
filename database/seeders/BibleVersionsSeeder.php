<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BibleVersionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bible_versions')->insert([
            [
                'name' => 'NIV'
            ],
            [
                'name' => 'NRSV'
            ],
            [
                'name' => 'KJV'
            ]
        ]);
    }
}
