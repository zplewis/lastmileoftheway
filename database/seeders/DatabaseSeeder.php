<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. From this class, you may use the "call"
     * method to run other seed classes, allowing you to control the seeding
     * order. This will be good as some tables depend on the existence of others.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TestamentsSeeder::class,
            BibleVersionsSeeder::class,
            // CommentSeeder::class,
        ]);
    }
}
