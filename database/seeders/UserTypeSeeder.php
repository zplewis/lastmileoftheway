<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            [
                'title' => 'No, I am planning a service for someone else',
                'item_order' => 1
            ],
            [
                'name' => 'Yes, I am planning a service for myself',
                'item_order' => 2
            ],
        ]);
    }
}
