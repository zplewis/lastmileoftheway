@extends('guide.container')

@section('guide.content')

<div class="col-12">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
        <label class="form-check-label" for="flexSwitchCheckChecked">Include Call to Worship to open the service</label>
    </div>
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'callToWorshipMinister', 'inputType' => 'text', 'labelText' => 'Officiating Minister', 'placeholder' => 'Pastor Thomas R. Farrow, Jr.'])
</div>

@endsection
