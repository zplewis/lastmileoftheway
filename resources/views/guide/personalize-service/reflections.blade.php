@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'reflectionsPerson1', 'inputType' => 'text', 'labelText' => 'Person #1', 'placeholder' => 'Coworker/Friend/Family'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'reflectionsPerson2', 'inputType' => 'text', 'labelText' => 'Person #2', 'placeholder' => 'Coworker/Friend/Family'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'reflectionsPerson3', 'inputType' => 'text', 'labelText' => 'Person #3', 'placeholder' => 'Coworker/Friend/Family'])
</div>


@endsection
