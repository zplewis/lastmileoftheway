@extends('guide.container')

@section('guide.content')

<div class="col-12">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
        <label class="form-check-label" for="flexSwitchCheckChecked">Include {{ $pageDesc }} in this service</label>
    </div>
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'invocationMinister', 'inputType' => 'text', 'labelText' => 'Sermon Minister', 'placeholder' => 'Pastor Thomas R. Farrow, Jr.'])
</div>

<div class="col-12">
    <label for="selectedHymn" class="form-label">Select a sermon type
    </label>
    <select class="form-select" id="selectedHymn" name="selectedHymn" aria-label="Select a hymn">
        <option {{ !old('selectedHymn') ? 'selected' : '' }}>Choose one</option>
        <!-- This needs to be populated from the database for data consistency -->
        <option value="0" {{ strcmp(old('selectedHymn'), '0') === 0 ? 'selected' : '' }}>Eulogy</option>
        <option value="1" {{ strcmp(old('selectedHymn'), '1') === 0 ? 'selected' : '' }}>Words of Comfort</option>
    </select>
</div>

@endsection
