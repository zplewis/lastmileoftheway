@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'dateBirth', 'inputType' => 'date', 'labelText' => 'Date of birth (MM/DD/YYYY)', 'pattern' => '\d{2}\/\d{2}\/\d{4}', 'required' => true])
</div>

@if (!$isUserIsDeceased)

    <div class="col-12">
        @include('guide.field', ['id' => 'dateDeath', 'inputType' => 'date', 'labelText' => 'Date of passing away (MM/DD/YYYY)', 'pattern' => '\d{2}\/\d{2}\/\d{4}'])
    </div>

    <div class="col-12">
        @include('guide.field', ['id' => 'dateService', 'inputType' => 'date', 'labelText' => 'Desired Service date (MM/DD/YYYY)', 'pattern' => '\d{2}\/\d{2}\/\d{4}'])
    </div>
@endif

@endsection
