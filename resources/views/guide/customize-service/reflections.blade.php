@extends('guide.container')

@section('guide.content')


<div class="col-12">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
        <label class="form-check-label" for="flexSwitchCheckChecked">Include {{ $pageDesc }} in this service</label>
    </div>
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'callToWorshipMinister', 'inputType' => 'text', 'labelText' => 'Person #1', 'placeholder' => 'Friend/relative/loved one'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'callToWorshipMinister', 'inputType' => 'text', 'labelText' => 'Person #2', 'placeholder' => 'Friend/relative/loved one'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'callToWorshipMinister', 'inputType' => 'text', 'labelText' => 'Person #3', 'placeholder' => 'Friend/relative/loved one'])
</div>


@endsection
