<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Testament;

class BibleBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldTestament = Testament::where('name', 'old')->first()->id;
        $newTestament = Testament::where('name', 'new')->first()->id;

        $list = [
            $oldTestament => [
                [
                    'name' => 'Genesis',
                    'item_order' => 1
                ],
                [
                    'name' => 'Exodus',
                    'item_order' => 2
                ],
                [
                    'name' => 'Leviticus',
                    'item_order' => 3
                ],
                [
                    'name' => 'Numbers',
                    'item_order' => 4
                ],
                [
                    'name' => 'Deuteronomy',
                    'item_order' => 5
                ],
                [
                    'name' => 'Joshua',
                    'item_order' => 6
                ],
                [
                    'name' => 'Judges ',
                    'item_order' => 7
                ],
                [
                    'name' => 'Ruth',
                    'item_order' => 8
                ],
                [
                    'name' => '1 Samuel',
                    'item_order' => 9
                ],
                [
                    'name' => '2 Samuel',
                    'item_order' => 10
                ],
                [
                    'name' => '1 Kings',
                    'item_order' => 11
                ],
                [
                    'name' => '2 Kings',
                    'item_order' => 12
                ],
                [
                    'name' => '1 Chronicles',
                    'item_order' => 13
                ],
                [
                    'name' => '2 Chronicles',
                    'item_order' => 14
                ],
                [
                    'name' => 'Ezra',
                    'item_order' => 15
                ],
                [
                    'name' => 'Nehemiah',
                    'item_order' => 16
                ],
                [
                    'name' => 'Esther',
                    'item_order' => 17
                ],
                [
                    'name' => 'Job',
                    'item_order' => 18
                ],
                [
                    'name' => 'Psalm',
                    'item_order' => 19
                ],
                [
                    'name' => 'Proverbs',
                    'item_order' => 20
                ],
                [
                    'name' => 'Ecclesiastes',
                    'item_order' => 21
                ],
                [
                    'name' => 'Song of Solomon',
                    'item_order' => 22
                ],
                [
                    'name' => 'Isaiah',
                    'item_order' => 23
                ],
                [
                    'name' => 'Jeremiah',
                    'item_order' => 24
                ],
                [
                    'name' => 'Lamentations',
                    'item_order' => 25
                ],
                [
                    'name' => 'Ezekiel',
                    'item_order' => 26
                ],
                [
                    'name' => 'Daniel',
                    'item_order' => 27
                ],
                [
                    'name' => 'Hosea',
                    'item_order' => 28
                ],
                [
                    'name' => 'Joel',
                    'item_order' => 29
                ],
                [
                    'name' => 'Amos',
                    'item_order' => 30
                ],
                [
                    'name' => 'Obadiah',
                    'item_order' => 31
                ],
                [
                    'name' => 'Jonah',
                    'item_order' => 32
                ],
                [
                    'name' => 'Micah',
                    'item_order' => 33
                ],
                [
                    'name' => 'Nahum',
                    'item_order' => 34
                ],
                [
                    'name' => 'Habakkuk',
                    'item_order' => 35
                ],
                [
                    'name' => 'Zephaniah',
                    'item_order' => 36
                ],
                [
                    'name' => 'Haggai',
                    'item_order' => 37
                ],
                [
                    'name' => 'Zechariah',
                    'item_order' => 38
                ],
                [
                    'name' => 'Malachi',
                    'item_order' => 39
                ],
            ],
            $newTestament => [
                [
                    'name' => 'Matthew',
                    'item_order' => 40
                ],
                [
                    'name' => 'Mark',
                    'item_order' => 41
                ],
                [
                    'name' => 'Luke',
                    'item_order' => 42
                ],
                [
                    'name' => 'John',
                    'item_order' => 43
                ],
                [
                    'name' => 'Acts',
                    'item_order' => 44
                ],
                [
                    'name' => 'Romans',
                    'item_order' => 45
                ],
                [
                    'name' => '1 Corinthians',
                    'item_order' => 46
                ],
                [
                    'name' => '2 Corinthians',
                    'item_order' => 47
                ],
                [
                    'name' => 'Galatians',
                    'item_order' => 48
                ],
                [
                    'name' => 'Ephesians',
                    'item_order' => 49
                ],
                [
                    'name' => 'Philippians',
                    'item_order' => 50
                ],
                [
                    'name' => 'Colossians',
                    'item_order' => 51
                ],
                [
                    'name' => '1 Thessalonians',
                    'item_order' => 52
                ],
                [
                    'name' => '2 Thessalonians',
                    'item_order' => 53
                ],
                [
                    'name' => '1 Timothy',
                    'item_order' => 54
                ],
                [
                    'name' => '2 Timothy',
                    'item_order' => 55
                ],
                [
                    'name' => 'Titus',
                    'item_order' => 56
                ],
                [
                    'name' => 'Philemon',
                    'item_order' => 57
                ],
                [
                    'name' => 'Hebrews',
                    'item_order' => 58
                ],
                [
                    'name' => 'James',
                    'item_order' => 59
                ],
                [
                    'name' => '1 Peter',
                    'item_order' => 60
                ],
                [
                    'name' => '2 Peter',
                    'item_order' => 61
                ],
                [
                    'name' => '1 John',
                    'item_order' => 62
                ],
                [
                    'name' => '2 John',
                    'item_order' => 63
                ],
                [
                    'name' => '3 John',
                    'item_order' => 64
                ],
                [
                    'name' => 'Jude',
                    'item_order' => 65
                ],
                [
                    'name' => 'Revelation',
                    'item_order' => 66
                ],
            ]
        ];

        $data = [];

        foreach ($list as $testamentId => $books) {
            foreach ($books as $book) {
                $book['testament_id'] = $testamentId;
                $data[] = $book;
            }
        }

        DB::table('bible_books')->insert($data);
    }
}
