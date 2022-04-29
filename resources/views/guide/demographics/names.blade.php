@extends('guide.container')

@section('guide.content')

<div class="col-sm-6">
    @include('guide.field', ['id' => 'userFirstName', 'inputType' => 'text', 'labelText' => 'First name', 'required' => true])
</div>
<div class="col-sm-6">
    @include('guide.field', ['id' => 'userLastName', 'inputType' => 'text', 'labelText' => 'Last name', 'required' => true])
</div>
<div class="col-12">
    @include('guide.field', ['id' => 'userEmail', 'inputType' => 'email', 'labelText' => 'Email address', 'required' => true])
</div>

<div class="col-12">
    {{-- This select menu lists the song types --}}
    @include(
    'guide.select',
    [
        'id' => 'userIsDeceased',
        'labelText' => 'Are you planning a service for yourself?',
        'collection' => \App\Models\UserType::orderBy('item_order')->get(),
        'textProp' => 'title',
        'required' => true
    ]
    )
</div>

<div class="col-12">
    @include('guide.field', ['id' => 'deceasedPreferredName', 'inputType' => 'text', 'labelText' => ($isUserIsDeceased === true ? 'Preferred Name' : 'Deceased Preferred Name')])
</div>


<div class="demographics-someone-else-name {{ $isUserIsDeceased !== true ? '' : 'd-none' }}">
    <div class="col-sm-6">
        @include('guide.field', ['id' => 'deceasedFirstName', 'inputType' => 'text', 'labelText' => 'Deceased First name', 'required' => $isUserIsDeceased !== true])
    </div>
    <div class="col-sm-6">
        @include('guide.field', ['id' => 'deceasedLastName', 'inputType' => 'text', 'labelText' => 'Deceased Last name', 'required' => $isUserIsDeceased !== true])
    </div>
</div> <!-- /.demographics-someone-else-name -->
@endsection
