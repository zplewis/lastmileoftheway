@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include('guide.field', ['id' => 'dateBirth', 'inputType' => 'date', 'labelText' => 'Date of birth'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'dateDeath', 'inputType' => 'date', 'labelText' => 'Date of passing away'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'dateService', 'inputType' => 'date', 'labelText' => 'Desired Service date'])
</div>

<div class="col-12">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
        <label class="form-check-label" for="flexSwitchCheckChecked">Include a
            <a href="/resources/glossary#viewing" title="Glossary - Viewing" target="_blank">viewing</a> one hour prior to start of the service</label>
    </div>
</div>

@endsection
