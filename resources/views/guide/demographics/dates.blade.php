@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'dateBirth', 'inputType' => 'date', 'labelText' => 'Date of birth'])
</div>

@if (strcasecmp(\App\Models\UserType::where('title', 'like', '%self%')->first()->id, session('userIsDeceased')) !== 0)

    <div class="col-12">
        @include('guide.field', ['id' => 'dateDeath', 'inputType' => 'date', 'labelText' => 'Date of passing away'])
    </div>

    <div class="col-12">
        @include('guide.field', ['id' => 'dateService', 'inputType' => 'date', 'labelText' => 'Desired Service date'])
    </div>
@endif

@endsection
