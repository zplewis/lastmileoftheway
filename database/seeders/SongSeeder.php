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
                'name' => 'Great is Thy Faithfulness',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'Blessed Assurance',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'What a Friend We Have in Jesus',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'On Christ the Solid Rock I Stand',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'It is Well',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'Amazing Grace',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'Holy, Holy, Holy',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'Safe in His Arms',
                'release_year' => 1986,
                'artist' => 'Rev. Milton Brunson & The Thompson Community Singers',
                'album' => 'There Is Hope',
                'youtube_url' => 'https://youtu.be/i6lDRc8hZYA',
                'spotify_url' => ''
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'My Soul Has Been Anchored',
                'release_year' => null,
                'artist' => 'Douglas Miller',
                'album' => 'Unspeakable Joy',
                'youtube_url' => 'https://youtu.be/ENv7zIo_j9M',
                'spotify_url' => null
            ],
        ]);
    }
}
