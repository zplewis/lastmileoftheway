@extends('guide.container')

@section('guide.content')

@php
    $testament = \App\Models\Testament::where('name', $testament ?? 'old')->first();
    $inputId = $testament->name . 'TestamentReading';
    $scriptures = \App\Models\Scriptures::whereHas('bible_versions', function ($query) use ($bible_version) {
                                    $query->where('id', $bible_version->id);
                                })
                                ->whereHas('bible_book.testament', function ($query) use ($testament) {
                                    $query->where('name', $testament->name);
                                })->orderBy('title')->get();
    $selectedScriptureId = (session($inputId) ?? old($inputId));
    $selectedScripture = $scriptures->where('id', $selectedScriptureId)->first();
@endphp

<div class="col-12">

    {{-- This select menu lists the song types --}}
    @include('guide.select', ['id' => $inputId, 'labelText' => 'Select a reading', 'collection' => $scriptures, 'textProp' => 'title', 'textProp2' => 'location'])

</div>

<div class="col-12 {{ $selectedScriptureId ? '' : 'd-none' }}">
    <figure>
        <blockquote class="blockquote">{{ $selectedScriptureId && $selectedScripture ? $selectedScripture->verses : '' }}</blockquote>
        <figcaption class="blockquote-footer">
            <span class="scripture-location">{{ $selectedScriptureId ? $selectedScripture->location : '' }}</span>
            <cite class="scripture-version" title="Bible Version">({{ $selectedScriptureId ? $selectedScripture->bible_versions->name : '' }})</cite>
        </figcaption>
    </figure>
</div>

<div class="col-12">
    @include('guide.field', ['id' => $inputId . 'Custom', 'inputType' => 'text', 'labelText' => 'Or, feel free to specify your own below:'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => $inputId . 'Reader', 'inputType' => 'text', 'labelText' => 'Scripture reader', 'placeholder' => 'Who will read this Scripture?'])
</div>

@endsection
