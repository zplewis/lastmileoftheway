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
        $nrsv = BibleVersions::where('acronymn', 'NRSV')->first()->id;

        $scriptures = [
            $nrsv => [
                [
                    'bible_book_id' => BibleBook::where('name', 'Job')->first()->id,
                    'title' => 'My Redeemer Lives',
                    'location' => 'Job 19:23-27',
                    'verses' => "Oh that my words were now written! Oh that they were printed in a
                    book! That they were graven with an iron pen and lead In the rock for ever! For
                    I know that my redeemer liveth, And that he shall stand at the latter day upon
                    the earth: And though after my skin worms destroy this body, Yet in my flesh
                    shall I see God: Whom I shall see for myself, And mine eyes shall behold, and
                    not another; Though my reins be consumed within me."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'The Shepherd\'s Psalm',
                    'location' => 'Psalm 23',
                    'verses' => "The Lord is my shepherd, I shall not want. He makes me lie down in
                    green pastures; he leads me beside still waters; he restores my soul. He leads
                    me in right paths for his name's sake. Even though I walk through the darkest
                    valley, I fear no evil; for you are with me; your rod and your staff—they
                    comfort me. You prepare a table before me in the presence of my enemies; you
                    anoint my head with oil; my cup overflows. Surely goodness and mercy shall
                    follow me all the days of my life, and I shall dwell in the house of the Lord
                    my whole life long."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Matthew')->first()->id,
                    'title' => 'Rest For Our Soul',
                    'location' => 'Matthew 11:28-30',
                    'verses' => "\"Come to me, all you that are weary and are carrying heavy
                    burdens, and I will give you rest. 29Take my yoke upon you, and learn from me;
                    for I am gentle and humble in heart, and you will find rest for your souls.
                    For my yoke is easy, and my burden is light.\""
                ],
            ]
        ];

        $data = [];

        foreach ($scriptures as $version => $passages) {
            foreach ($passages as $passage) {
                $passage['bible_versions_id'] = $nrsv;
                Log::debug('passage: ', $passage);
                $data[] = $passage;
            }
        }

        DB::table('scriptures')->insert($data);
    }
}
