@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'invocationMinister', 'inputType' => 'text', 'labelText' => 'Prayer of Comfort', 'placeholder' => 'Name of person'])
</div>

@endsection
