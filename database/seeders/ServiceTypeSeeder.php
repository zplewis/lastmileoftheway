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
                'description' => 'Service held outside at the burial site'
            ],
            [
                'title' => 'Funeral',
                'description' => 'Service held in church or funeral home'
            ],
            [
                'title' => 'Memorial',
                'description' => 'Service held when burial is not possible'
            ]
        ]);
    }
}
