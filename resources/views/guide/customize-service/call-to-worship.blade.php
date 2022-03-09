@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'callToWorshipMinister', 'inputType' => 'text', 'labelText' => 'Officiating Minister', 'placeholder' => 'Pastor Thomas R. Farrow, Jr.'])
</div>

@endsection
