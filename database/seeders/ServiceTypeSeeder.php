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
                'description' => 'Service held outside at the burial site',
                'bullet_points' => 'Suitable for smaller services,Great for social distancing, Weather-contingent'
            ],
            [
                'title' => 'Funeral',
                'description' => 'Service held in church or funeral home',
                'bullet_points' => 'What most people think of as a burial service,Capacity dependent upon venue'
            ],
            [
                'title' => 'Memorial',
                'description' => 'Service held when burial is not possible',
                'bullet_points' => 'Most flexible concerning location,Tends to be a shorter service,Preaching optional'
            ]
        ]);
    }
}
