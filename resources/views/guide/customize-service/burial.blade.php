@extends('guide.container')

@section('guide.content')

@include('guide.switch', ['id' => 'isBurialAfterService', 'labelText' => 'Burial is immediately following the service?'])

<div class="col-12">
    @include('guide.field', ['id' => 'serviceLocation', 'inputType' => 'text', 'labelText' => 'Location for burial (if known)'])
</div>

@endsection
