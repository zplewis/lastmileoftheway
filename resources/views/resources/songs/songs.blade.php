<div class="col-12 col-md-9">

    <h1>Recommended songs</h1>

    <p class="lead">Here are some sample songs that can be used during different times during the
        service.
    </p>

    <form action="/{{ request()->path() }}" method="POST" id="guide-form">
        @csrf
@php
    $songTypes = \App\Models\SongType::orderBy('name')->get();
    $selectedSongType = (session('songType') ?? old('songType'));
    $selectedSongId = (session('song') ?? old('song'));
    $selectedSongTypeModel = $songTypes->where('id', $selectedSongType)->first();
    $selectedSongTypeName = $selectedSongTypeModel === null ? 'song' : $selectedSongTypeModel->name;
    $songs = \App\Models\Song::where('song_type_id', $selectedSongType)->orderBy('name')->get();
    $selectedSong = $songs->where('id', $selectedSongId)->first();
    $selectedSongYouTube = $selectedSong !== null && $selectedSong->youtube_url ? $selectedSong->youtube_url : '';
@endphp

<div class="col-12 mb-3">

    {{-- This select menu lists the song types --}}
    @include('guide.select', ['id' => 'songType', 'labelText' => 'Select a song type', 'collection' => $songTypes, 'textProp' => 'name'])

</div>

<div class="col-12 mb-3">
    {{-- This select menu lists the song types --}}
    @include(
    'guide.select',
    [
        'id' => 'song',
        'labelText' => 'Select a ' . $selectedSongTypeName,
        'collection' => $songs,
        'textProp' => 'name',
        'textProp2' => 'artist',
        'dataAttributes' => [
            'data-youtube-url' => 'youtube_url',
            'data-release-year' => 'release_year'
        ]
    ]
    )
</div>

<div class="col-12 col-md-4 {{ $selectedSongYouTube ? '' : 'd-none' }}" id="song-youtube-preview">
    <label for="youtube-player">YouTube Preview</label>
    <iframe id="youtube-player" width="100%" height="400px" src="{{ $selectedSongYouTube ? $selectedSong->youtube_url : '' }}?&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

</form>

</div> <!-- /.col-12 -->
