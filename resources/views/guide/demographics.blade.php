@extends('guide.container')

@section('guide.content')
<div class="col-sm-6">
    <label for="userFirstName" class="form-label">First name</label>
    @include('guide.field', ['id' => 'userFirstName'])
</div>
<div class="col-sm-6">
    <label for="userLastName" class="form-label">Last name</label>
    @include('guide.field', ['id' => 'userLastName'])
</div>
<div class="col-12">
    <label for="userEmail" class="form-label">Email address</label>
    @include('guide.field', ['id' => 'userEmail', 'inputType' => 'email'])
</div>
<div class="col-12">
    <label for="userIsDeceased" class="form-label">Are you planning a service
        for yourself?
    </label>
    <select class="form-select" id="userIsDeceased" name="userIsDeceased" aria-label="Is user planning for themselves?">
        <option {{ !old('userIsDeceased') ? 'selected' : '' }}>Choose one</option>
        <!-- This needs to be populated from the database for data consistency -->
        <option value="0" {{ strcmp(old('userIsDeceased'), '0') === 0 ? 'selected' : '' }}>No, I am planning a service for someone else</option>
        <option value="1" {{ strcmp(old('userIsDeceased'), '1') === 0 ? 'selected' : '' }}>Yes, I am planning a service for myself</option>
    </select>
</div>
<div class="col-sm-6">
    <label for="deceasedFirstName" class="form-label">Deceased First name</label>
    @include('guide.field', ['id' => 'deceasedFirstName'])
</div>
<div class="col-sm-6">
    <label for="deceasedLastName" class="form-label">Deceased Last name</label>
    @include('guide.field', ['id' => 'deceasedLastName'])
</div>
<div class="col-12">
    <label for="deceasedDisplayName" class="form-label">Deceased Display name</label>
    @include('guide.field', ['id' => 'deceasedDisplayName'])
</div>
@endsection
