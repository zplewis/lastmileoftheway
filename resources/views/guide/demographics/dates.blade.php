@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'dateBirth', 'inputType' => 'date', 'labelText' => 'Date of birth'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'dateDeath', 'inputType' => 'date', 'labelText' => 'Date of passing away'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'dateService', 'inputType' => 'date', 'labelText' => 'Service date (if known)'])
</div>

@endsection
