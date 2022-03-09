@extends('guide.container')

@section('guide.content')

<div class="col-12">
    <label for="selectedHymn" class="form-label">Select a musical selection
    </label>
    <select class="form-select" id="selectedHymn" name="selectedHymn" aria-label="Select a hymn">
        <option {{ !old('selectedHymn') ? 'selected' : '' }}>Choose one</option>
        <!-- This needs to be populated from the database for data consistency -->
        <option value="0" {{ strcmp(old('selectedHymn'), '0') === 0 ? 'selected' : '' }}>Amazing Grace</option>
        <option value="1" {{ strcmp(old('selectedHymn'), '1') === 0 ? 'selected' : '' }}>It is Well with My Soul</option>
        <option value="2" {{ strcmp(old('selectedHymn'), '2') === 0 ? 'selected' : '' }}>Great is Thy Faithfulness</option>
    </select>
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'customHymn', 'inputType' => 'text', 'labelText' => 'Or, feel free to specify your own below:'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'invocationMinister', 'inputType' => 'text', 'labelText' => 'Who is rendering the music?', 'placeholder' => 'Church music ministry'])
</div>

@endsection
