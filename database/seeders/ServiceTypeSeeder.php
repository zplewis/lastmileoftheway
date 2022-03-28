<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_types')->insert([
            [
                'title' => 'Graveside',
                'description' => 'A funeral that takes place at the graveside',
                'bullet_points' => 'Shorter service,Weather and time-contingent'
            ],
            [
                'title' => 'Funeral',
                'description' => 'Takes place in a church or funeral home with the body present',
                'bullet_points' => 'Capacity dependent upon location,More time contingent'
            ],
            [
                'title' => 'Memorial',
                'description' => 'A service intended to remember and honor the life of someone who has died',
                'bullet_points' => 'Body is not present,Less time contingent'
            ]
        ]);
    }
}
