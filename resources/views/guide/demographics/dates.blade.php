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
        @include('guide.field', ['id' => 'dateService', 'inputType' => 'datetime-local', 'labelText' => 'Desired Service date and time (MM/DD/YYYY)'])
    </div>

    <div class="col-6 d-none">
        @include('guide.field', ['id' => 'dateServiceDate', 'inputType' => 'date', 'labelText' => 'Desired Service date (MM/DD/YYYY)'])
    </div>
    <div class="col-6 d-none">
        @include('guide.field', ['id' => 'dateServiceTime', 'inputType' => 'time', 'labelText' => 'Desired Service time (HH:MM AM)'])
    </div>

@endif

@endsection
