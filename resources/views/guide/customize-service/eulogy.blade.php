@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'invocationMinister', 'inputType' => 'text', 'labelText' => 'Sermon Minister', 'placeholder' => 'Pastor Thomas R. Farrow, Jr.'])
</div>

<div class="col-12">
    @include('guide.select', ['id' => $currentQuestion->uri, 'labelText' => 'Select a ' . $currentQuestion->title . ' type', 'collection' => \App\Models\SermonType::orderBy('title')->get(), 'textProp' => 'title'])
</div>

@endsection
