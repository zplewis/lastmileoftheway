@extends('guide.container')

@section('guide.content')

<div class="col-12">
    @include(
        'guide.field',
        [
            'id' => 'serviceLocation',
            'inputType' => 'text',
            'labelText' => 'Location for service (if known)',
            'value' => 'Reeder Memorial Baptist Church'
        ]
    )
</div>

<div class="col-12">
    @include(
        'guide.field',
        [
            'id' => 'viewingLocation',
            'inputType' => 'text',
            'labelText' => 'Location for viewing (if known)',
            'value' => 'Reeder Memorial Baptist Church'
        ]
    )
</div>

@endsection
