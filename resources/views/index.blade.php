@extends('layout')

@section('content')
    @include('index.hero')
    @include('index.text-before-services')
    <div class="container">
        @include('index.services')
    </div>
    @include('index.shortad')
    @include('index.asking-questions')
@endsection
