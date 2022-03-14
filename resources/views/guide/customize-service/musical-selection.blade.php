@extends('guide.container')

@section('guide.content')

@php
    $songTypes = \App\Models\SongType::all();
    $selectedSongType = (session('songType' . ($musicalSelectionIndex)) ?? old('songType' . ($musicalSelectionIndex)));
    $selectedSongTypeModel = $songTypes->where('id', $selectedSongType)->first();
    $selectedSongTypeName = $selectedSongTypeModel === null ? 'song' : $selectedSongTypeModel->name;
@endphp

<pre>
    songType{{ $musicalSelectionIndex }}: {{ $selectedSongType }}
</pre>

<div class="col-12">

    {{-- This select menu lists the song types --}}
    @include('guide.select', ['id' => 'songType' . ($musicalSelectionIndex ?? '1'), 'labelText' => 'Select a song type', 'collection' => $songTypes, 'textProp' => 'name'])

</div>

<div class="col-12">
    {{-- This select menu lists the song types --}}
    @include('guide.select', ['id' => 'song' . ($musicalSelectionIndex ?? '1'), 'labelText' => 'Select a ' . $selectedSongTypeName, 'collection' => \App\Models\Song::where('song_type_id', $selectedSongType)->get(), 'textProp' => 'name', 'textProp2' => 'artist'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'songCustom' . ($musicalSelectionIndex ?? '1'), 'inputType' => 'text', 'labelText' => 'Or, feel free to specify your own below:'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'songMinister' . ($musicalSelectionIndex ?? '1'), 'inputType' => 'text', 'labelText' => 'Who is rendering the music?', 'placeholder' => 'Church music ministry'])
</div>

@endsection
