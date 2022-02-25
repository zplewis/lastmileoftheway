<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('song_types')->insert([
            [
                'name' => 'Hymn'
            ],
            [
                'name' => 'Selection'
            ],
            [
                'name' => 'Solo'
            ]
        ]);
    }
}
