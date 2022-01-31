<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name' => 'old'
            ],
            [
                'name' => 'new'
            ]
        ]);
    }
}
