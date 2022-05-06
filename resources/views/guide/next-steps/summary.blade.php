

@extends('guide.container')

@section('guide.content')

@include('guide.next-steps.incomplete-warning')

@if (request()->is('*/pdf*'))
    @include('guide.next-steps.summary-pdf')
@else
@include('guide.next-steps.summary-details')
@endif

@endsection
