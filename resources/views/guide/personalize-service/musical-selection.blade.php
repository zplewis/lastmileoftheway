@extends('guide.container')

@section('guide.content')

@php
    $songTypes = \App\Models\SongType::orderBy('name')->get();
    $selectedSongType = (session('songType' . ($musicalSelectionIndex)) ?? old('songType' . ($musicalSelectionIndex)));
    $selectedSongId = (session('song' . ($musicalSelectionIndex)) ?? old('song' . ($musicalSelectionIndex)));
    $selectedSongTypeModel = $songTypes->where('id', $selectedSongType)->first();
    $selectedSongTypeName = $selectedSongTypeModel === null ? 'song' : $selectedSongTypeModel->name;
    $songs = \App\Models\Song::where('song_type_id', $selectedSongType)->orderBy('name')->get();
    $selectedSong = $songs->where('id', $selectedSongId)->first();
    $selectedSongYouTube = $selectedSong !== null && $selectedSong->youtube_url ? $selectedSong->youtube_url : null;
    $songMinisterPlaceholder = $currentServiceType !== null && strcasecmp($currentServiceType->title, 'graveside') === 0 ? 'RMBC Soloist' : 'RMBC Music Ministry';
@endphp

{{-- hasMusicalSelection1: NOT required
    songMinister1: required_unless:hasMusicalSelection1,null
    songType1: NOT required (although you cannot select a song without this)
    song1: required if: hasMusicalSelection1 === yes && songCustom1 === null
    songCustom1: required if: hasMusicalSelection1 === yes && song1 === null --}}

<div class="col-12">

    {{-- This select menu lists the song types --}}
    @include('guide.select', ['id' => 'songType' . ($musicalSelectionIndex ?? '1'), 'labelText' => 'Select a song type', 'collection' => $songTypes, 'textProp' => 'name'])

</div>

<div class="col-12 mb-3">
    {{-- This select menu lists the song types --}}
    @include(
    'guide.select',
    [
        'id' => 'song' . ($musicalSelectionIndex ?? '1'),
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

<div class="col-12 col-md-4 {{ $selectedSongYouTube ? '' : 'd-none' }}" id="song-youtube-preview{{ ($musicalSelectionIndex ?? '1') }}">
    <iframe width="100%" height="300px" src="{{ $selectedSongYouTube ? $selectedSong->youtube_url : '' }}?&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'songCustom' . ($musicalSelectionIndex ?? '1'), 'inputType' => 'text', 'labelText' => 'Or, feel free to specify your own below:', 'defaultOptionText' => 'Please choose a song.'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'songMinister' . ($musicalSelectionIndex ?? '1'), 'inputType' => 'text', 'labelText' => 'Who is rendering the music?', 'placeholder' => $songMinisterPlaceholder])
</div>

@endsection
