<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SermonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sermon_types')->insert([
            [
                'title' => 'Eulogy',
            ],
            [
                'title' => 'Words of Comfort',
            ]
        ]);
    }
}
