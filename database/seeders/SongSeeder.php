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
                'youtube_url' => 'https://www.youtube.com/embed/CBKwV6oNYvw',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $hymnId,
                'name' => 'Holy, Holy, Holy',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/KZM6PoTy31g',
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
                'song_type_id' => $selectionId,
                'name' => 'Order My Steps',
                'release_year' => 1993,
                'artist' => 'GMWA Women of Worship',
                'album' => 'It\'s Our Time',
                'youtube_url' => 'https://www.youtube.com/embed/kCSuw1zs8Kw',
                'spotify_url' => ''
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'Stand',
                'release_year' => 1996,
                'artist' => 'Donnie McClurkin',
                'album' => 'Donnie McClurkin',
                'youtube_url' => 'https://www.youtube.com/embed/f_AZWYVlzD8',
                'spotify_url' => ''
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'More Than I Can Bear',
                'release_year' => 1996,
                'artist' => 'Kirk Franklin',
                'album' => 'God\'s Property',
                'youtube_url' => 'https://www.youtube.com/embed/WDuvsUTpUWw',
                'spotify_url' => ''
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'When We All Get to Heaven',
                'release_year' => 2015,
                'artist' => 'Richard Smallwood',
                'album' => 'Anthology',
                'youtube_url' => 'https://www.youtube.com/embed/gTz71g8ePc8',
                'spotify_url' => ''
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'Soon and Very Soon',
                'release_year' => null,
                'artist' => 'Andraé Crouch',
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/ZmW-Tz6DFdc',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'Total Praise',
                'release_year' => null,
                'artist' => 'Richard Smallwood',
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/Vv9-WlymKg0',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'Through It All',
                'release_year' => null,
                'artist' => 'Andraé Crouch',
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/iB2pPCydEjs',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'Because He Lives',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/4M-zwE33zHA',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $selectionId,
                'name' => 'Tis So Sweet to Trust in Jesus',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/6vBBUNAzhRE',
                'spotify_url' => null
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
                'youtube_url' => 'https://www.youtube.com/embed/CBKwV6oNYvw',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'Great is Thy Faithfulness',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/cLOMz1ybYQg',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'If I Can Help Somebody',
                'release_year' => null,
                'artist' => null,
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/AOA7sHQrgcU',
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
                'release_year' => 1981,
                'artist' => 'Douglas Miller',
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/_QOUNpfq5WU',
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
            [
                'song_type_id' => $soloId,
                'name' => 'I Look to You',
                'release_year' => null,
                'artist' => 'Whitney Houston',
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/5Pze_mdbOK8',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'Come Ye Disconsolate',
                'release_year' => 2004,
                'artist' => 'Ted & Sheri',
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/HbW_f5rTGxQ',
                'spotify_url' => null
            ],
            [
                'song_type_id' => $soloId,
                'name' => 'Stand',
                'release_year' => 1996,
                'artist' => 'Donnie McClurkin',
                'album' => null,
                'youtube_url' => 'https://www.youtube.com/embed/I7XLHvj96t0',
                'spotify_url' => null
            ],
        ]);
    }
}
