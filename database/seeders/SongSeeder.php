<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\SongType;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hymnId = SongType::where('name', 'Hymn')->first()->id;
        $selectionId = SongType::where('name', 'Selection')->first()->id;
        $soloId = SongType::where('name', 'Solo')->first()->id;

        DB::table('songs')->insert([
            [
                'song_type_id' => $hymnId,
                'name' => 'Great is Thy Faithfulness'
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'Blessed Assurance'
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'What a Friend We Have in Jesus'
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'On Christ the Solid Rock I Stand'
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'It is Well'
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'Amazing Grace'
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'Holy, Holy, Holy'
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'Great is Thy Faithfulness'
            ],
        ]);
    }
}
