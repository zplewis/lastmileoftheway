@extends('guide.container')

@section('guide.content')

@if ($currentServiceType !== null)
    @include('guide.field', ['inputType' => 'hidden', 'id' => 'previous-submission', 'value' => 'yes'])
@endif

@endsection
