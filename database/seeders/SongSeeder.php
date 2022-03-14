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
                'youtube_url' => 'https://www.youtube.com/embed/cLOMz1ybYQg',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'Blessed Assurance',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/uMLOlYWM03g',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'What a Friend We Have in Jesus',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/yFQjTTdxr9k',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'On Christ the Solid Rock I Stand',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/AqXLvMB3cWI',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'It is Well',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/E6Td6we_WUc',
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
                'youtube_url' => 'https://www.youtube.com/embed/i6lDRc8hZYA',
                'spotify_url' => ''
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'My Soul Has Been Anchored',
                'release_year' => null,
                'artist' => 'Douglas Miller',
                'album' => 'Unspeakable Joy',
                'youtube_url' => 'https://www.youtube.com/embed/ENv7zIo_j9M',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'How Great Thou Art',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/BsBT_Mo8_vg',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'Precious Lord',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/PpFq9gxBxhk?t=20',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'Amazing Grace',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'Great is Thy Faithfulness',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'If I Can Help Somebody',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'His Eye is on The Sparrow',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/k7Pk5YMkEcg',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'When I See Jesus',
                'release_year' => null,
                'artist' => 'Douglas Miller',
                'album' => null,
                'youtube_url' => null,
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'The Last Mile of the Way',
                'release_year' => null,
                'artist' => 'Sam Cooke & The Soul Stirrers',
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/ELA_pkY1IfA',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'Take Me to The King',
                'release_year' => 2016,
                'artist' => 'Tamela Mann',
                'album' => 'Best Days',
                'youtube_url' => 'https://www.youtube.com/embed/XvV9p-wU4hk',
                'spotify_url' => null
            ],
        ]);
    }
}
