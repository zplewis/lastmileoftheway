@extends('guide.container')

@section('guide.content')

<!-- user decides whether to include a reading of the obituary -->
@include('guide.switch', ['id' => 'obituaryReading', 'labelText' => 'Include a reading of the obituary'])

<div class="col-12">
    @include('guide.field', ['id' => 'invocationMinister', 'inputType' => 'text', 'labelText' => 'Designated person', 'placeholder' => 'Name of person'])
</div>

@endsection
