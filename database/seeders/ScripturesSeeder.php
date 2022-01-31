<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\BibleVersions;
use \App\Models\BibleBook;
use Illuminate\Support\Facades\Log;

class ScripturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nrsv = BibleVersions::where('name', 'NRSV')->first()->id;

        Log::debug('nrsv id: ' . $nrsv);

        $scriptures = [
            $nrsv = [
                [
                    'bible_book_id' => BibleBook::where('name', 'Job')->first()->id,
                    'title' => 'My Redeemer Lives',
                    'location' => 'Job 19:23-27',
                    'verses' => null
                ],
            ]
        ];

        $data = [];

        foreach ($scriptures as $version => $passages) {
            foreach ($passages as $passage) {
                $passage['bible_versions_id'] = $nrsv;
                $data[] = $passage;
            }
        }

        DB::table('scriptures')->insert($data);
    }
}
