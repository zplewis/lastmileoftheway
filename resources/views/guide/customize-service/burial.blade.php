@extends('guide.container')

@section('guide.content')

<div class="col-12">
    <label for="selectedHymn" class="form-label">Is the burial immediately following the service?
    </label>
    <select class="form-select" id="selectedHymn" name="selectedHymn" aria-label="Select a hymn">
        <!-- This needs to be populated from the database for data consistency -->
        <option value="1" {{ strcmp(old('selectedHymn'), '1') === 0 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ strcmp(old('selectedHymn'), '0') === 0 ? 'selected' : '' }}>No</option>
    </select>
</div>


<div class="col-12">
    @include('guide.field', ['id' => 'serviceLocation', 'inputType' => 'text', 'labelText' => 'Location for burial (if known)'])
</div>

@endsection
