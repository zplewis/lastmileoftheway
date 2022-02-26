@extends('guide.container')

@section('guide.content')

@php
    $songTypes = \App\Models\SongType::all();
@endphp

<div class="col-12">

    {{-- This select menu lists the song types --}}
    @include('guide.select', ['id' => 'songType1', 'labelText' => 'Select a song type', 'collection' => \App\Models\SongType::all(), 'textProp' => 'name'])

</div>

<div class="col-12">
    {{-- This select menu lists the song types --}}
    @include('guide.select', ['id' => 'song1', 'labelText' => 'Select a ' . (old('songType1') ?? 'song'), 'collection' => \App\Models\Song::all(), 'textProp' => 'name'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'songCustom1', 'inputType' => 'text', 'labelText' => 'Or, feel free to specify your own below:'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'songMinister1', 'inputType' => 'text', 'labelText' => 'Who is rendering the music?', 'placeholder' => 'Church music ministry'])
</div>

@endsection
