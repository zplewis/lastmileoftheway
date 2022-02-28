<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApptTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appt_types')->insert([
            [
                'name' => 'Zoom'
            ],
            [
                'name' => 'In-person (Charlotte area only)'
            ],
            [
                'name' => 'Phone call'
            ],
        ]);
    }
}
