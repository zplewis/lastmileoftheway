@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'invocationMinister', 'inputType' => 'text', 'labelText' => 'Invocation', 'placeholder' => 'Pastor Thomas R. Farrow, Jr.'])
</div>

@endsection
