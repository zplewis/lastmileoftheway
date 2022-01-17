<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testaments')->insert([
            [
                'name' => 'Old'
            ],
            [
                'name' => 'New'
            ]
        ]);
    }
}
