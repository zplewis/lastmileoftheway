@extends('guide.container')

@section('guide.content')

<div class="col-12">
    <label for="selectedOldReading" class="form-label">Select a reading
    </label>
    <select class="form-select" id="selectedOldReading" name="selectedOldReading" aria-label="Select a hymn">
        <option {{ !old('selectedOldReading') ? 'selected' : '' }}>Choose one</option>
        <!-- This needs to be populated from the database for data consistency -->
        <option value="0" {{ strcmp(old('selectedOldReading'), '0') === 0 ? 'selected' : '' }}>Job 19:23-27 - My Redeemer Lives</option>
        <option value="1" {{ strcmp(old('selectedOldReading'), '1') === 0 ? 'selected' : '' }}>Psalm 23 - The Shepherd's Psalm</option>
    </select>
</div>

<figure>
  <blockquote class="blockquote">
    <p class="small">23 “O that my words were written down!
    O that they were inscribed in a book!
24 O that with an iron pen and with lead
    they were engraved on a rock forever!
25 For I know that my Redeemer lives,
    and that at the last he will stand upon the earth;
26 and after my skin has been thus destroyed,
    then in my flesh I shall see God,
27 whom I shall see on my side,
    and my eyes shall behold, and not another.
    My heart faints within me!</p>
  </blockquote>
  <figcaption class="blockquote-footer">
    Job 19:23-27 <cite title="Source Title">(NRSV)</cite>
  </figcaption>
</figure>

<div class="col-12">
    @include('guide.field', ['id' => 'customHymn', 'inputType' => 'text', 'labelText' => 'Or, feel free to specify your own below:'])
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'invocationMinister', 'inputType' => 'text', 'labelText' => 'Scripture reader', 'placeholder' => 'Name of person'])
</div>

@endsection
