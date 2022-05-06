@extends('guide.container')

@section('guide.content')

@foreach (range(1, env('MIN_NUM_REFLECTIONS_PERSONS', 5)) as $index)
<div class="col-12">
    @include('guide.field', ['id' => 'reflectionsPerson' . $index, 'inputType' => 'text', 'labelText' => 'Person #' . $index, 'placeholder' => 'Coworker/Friend/Family'])
</div>
@endforeach

@endsection
