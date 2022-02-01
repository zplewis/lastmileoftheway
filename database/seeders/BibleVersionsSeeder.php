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
                'acronymn' => 'NIV',
                'name' => 'New International Version'
            ],
            [
                'acronymn' => 'NRSV',
                'name' => 'New Revised Standard Version'
            ],
            [
                'acronymn' => 'KJV',
                'name' => 'King James Version'
            ]
        ]);
    }
}
