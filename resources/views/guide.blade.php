@extends('layout')

@section('content')

<!-- the entire page is divided into two columns inside a row; this example comes from https://getbootstrap.com/docs/5.1/components/scrollspy/#example-with-nested-nav -->
<div class="row">
    {{-- Only show the sidebar if viewing the guide question normally --}}
    @if (!$isPreview && !$isPdf)
        @include('guide.sidebar')
    @endif
    @include('guide.' . ($currentCategory->uri . '/' . $currentQuestion->uri))
</div>

@endsection
