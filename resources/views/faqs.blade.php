@extends('layout')

@section('content')

<!-- the entire page is divided into two columns inside a row; this example comes from https://getbootstrap.com/docs/5.1/components/scrollspy/#example-with-nested-nav -->
<div class="row">
    @include('faqs.sidebar')
    @include('faqs.answers')
</div>

@endsection
