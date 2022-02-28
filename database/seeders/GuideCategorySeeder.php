<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuideCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guide_categories')->insert([
            [
                'title' => 'Getting Started',
                'uri' => 'getting-started',
                'item_order' => 1
            ],
            [
                'title' => 'Demographics',
                'uri' => 'demographics',
                'item_order' => 2
            ],
            [
                'title' => 'Customize Service',
                'uri' => 'customize-service',
                'item_order' => 3
            ],
            [
                'title' => 'Next Steps',
                'uri' => 'next-steps',
                'item_order' => 4
            ],
        ]);
    }
}
