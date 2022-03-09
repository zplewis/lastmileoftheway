@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'callToWorshipMinister', 'inputType' => 'text', 'labelText' => 'Person #1', 'placeholder' => 'Friend/relative/loved one'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'callToWorshipMinister', 'inputType' => 'text', 'labelText' => 'Person #2', 'placeholder' => 'Friend/relative/loved one'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'callToWorshipMinister', 'inputType' => 'text', 'labelText' => 'Person #3', 'placeholder' => 'Friend/relative/loved one'])
</div>


@endsection
