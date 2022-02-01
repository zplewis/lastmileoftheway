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
                    'order' => 1
                ],
                [
                    'name' => 'Exodus',
                    'order' => 2
                ],
                [
                    'name' => 'Leviticus',
                    'order' => 3
                ],
                [
                    'name' => 'Numbers',
                    'order' => 4
                ],
                [
                    'name' => 'Deuteronomy',
                    'order' => 5
                ],
                [
                    'name' => 'Joshua',
                    'order' => 6
                ],
                [
                    'name' => 'Judges ',
                    'order' => 7
                ],
                [
                    'name' => 'Ruth',
                    'order' => 8
                ],
                [
                    'name' => '1 Samuel',
                    'order' => 9
                ],
                [
                    'name' => '2 Samuel',
                    'order' => 10
                ],
                [
                    'name' => '1 Kings',
                    'order' => 11
                ],
                [
                    'name' => '2 Kings',
                    'order' => 12
                ],
                [
                    'name' => '1 Chronicles',
                    'order' => 13
                ],
                [
                    'name' => '2 Chronicles',
                    'order' => 14
                ],
                [
                    'name' => 'Ezra',
                    'order' => 15
                ],
                [
                    'name' => 'Nehemiah',
                    'order' => 16
                ],
                [
                    'name' => 'Esther',
                    'order' => 17
                ],
                [
                    'name' => 'Job',
                    'order' => 18
                ],
                [
                    'name' => 'Psalm',
                    'order' => 19
                ],
                [
                    'name' => 'Proverbs',
                    'order' => 20
                ],
                [
                    'name' => 'Ecclesiastes',
                    'order' => 21
                ],
                [
                    'name' => 'Song of Solomon',
                    'order' => 22
                ],
                [
                    'name' => 'Isaiah',
                    'order' => 23
                ],
                [
                    'name' => 'Jeremiah',
                    'order' => 24
                ],
                [
                    'name' => 'Lamentations',
                    'order' => 25
                ],
                [
                    'name' => 'Ezekiel',
                    'order' => 26
                ],
                [
                    'name' => 'Daniel',
                    'order' => 27
                ],
                [
                    'name' => 'Hosea',
                    'order' => 28
                ],
                [
                    'name' => 'Joel',
                    'order' => 29
                ],
                [
                    'name' => 'Amos',
                    'order' => 30
                ],
                [
                    'name' => 'Obadiah',
                    'order' => 31
                ],
                [
                    'name' => 'Jonah',
                    'order' => 32
                ],
                [
                    'name' => 'Micah',
                    'order' => 33
                ],
                [
                    'name' => 'Nahum',
                    'order' => 34
                ],
                [
                    'name' => 'Habakkuk',
                    'order' => 35
                ],
                [
                    'name' => 'Zephaniah',
                    'order' => 36
                ],
                [
                    'name' => 'Haggai',
                    'order' => 37
                ],
                [
                    'name' => 'Zechariah',
                    'order' => 38
                ],
                [
                    'name' => 'Malachi',
                    'order' => 39
                ],
            ],
            $newTestament => [
                [
                    'name' => 'Matthew',
                    'order' => 40
                ],
                [
                    'name' => 'Mark',
                    'order' => 41
                ],
                [
                    'name' => 'Luke',
                    'order' => 42
                ],
                [
                    'name' => 'John',
                    'order' => 43
                ],
                [
                    'name' => 'Acts',
                    'order' => 44
                ],
                [
                    'name' => 'Romans',
                    'order' => 45
                ],
                [
                    'name' => '1 Corinthians',
                    'order' => 46
                ],
                [
                    'name' => '2 Corinthians',
                    'order' => 47
                ],
                [
                    'name' => 'Galatians',
                    'order' => 48
                ],
                [
                    'name' => 'Ephesians',
                    'order' => 49
                ],
                [
                    'name' => 'Philippians',
                    'order' => 50
                ],
                [
                    'name' => 'Colossians',
                    'order' => 51
                ],
                [
                    'name' => '1 Thessalonians',
                    'order' => 52
                ],
                [
                    'name' => '2 Thessalonians',
                    'order' => 53
                ],
                [
                    'name' => '1 Timothy',
                    'order' => 54
                ],
                [
                    'name' => '2 Timothy',
                    'order' => 55
                ],
                [
                    'name' => 'Titus',
                    'order' => 56
                ],
                [
                    'name' => 'Philemon',
                    'order' => 57
                ],
                [
                    'name' => 'Hebrews',
                    'order' => 58
                ],
                [
                    'name' => 'James',
                    'order' => 59
                ],
                [
                    'name' => '1 Peter',
                    'order' => 60
                ],
                [
                    'name' => '2 Peter',
                    'order' => 61
                ],
                [
                    'name' => '1 John',
                    'order' => 62
                ],
                [
                    'name' => '2 John',
                    'order' => 63
                ],
                [
                    'name' => '3 John',
                    'order' => 64
                ],
                [
                    'name' => 'Jude',
                    'order' => 65
                ],
                [
                    'name' => 'Revelation',
                    'order' => 66
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
