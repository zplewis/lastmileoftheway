@extends('guide.container')

@section('guide.content')

<div class="col-12">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
        <label class="form-check-label" for="flexSwitchCheckChecked">Include {{ $pageDesc }} in this service</label>
    </div>
</div>

<div class="col-12">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="obituaryReading" checked>
        <label class="form-check-label" for="obituaryReading">Include a reading of the obituary</label>
    </div>
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'invocationMinister', 'inputType' => 'text', 'labelText' => 'Designated person', 'placeholder' => 'Name of person'])
</div>

@endsection
