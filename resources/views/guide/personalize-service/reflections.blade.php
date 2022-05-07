@extends('guide.container')

@section('guide.content')

@if(intval(session(\App\Http\Controllers\SubmissionController::NUM_REFLECTIONS_PERSONS, 2)) < intval(env('MAX_NUM_REFLECTIONS_PERSONS', 10)))
    <button type="button" id="increaseReflectionsBtn" name="increaseReflectionsBtn"
    class="btn btn-success mb-2">Add a person for reflections</button>
@endif

@foreach (range(1, session(\App\Http\Controllers\SubmissionController::NUM_REFLECTIONS_PERSONS, 2)) as $index)
<div class="col-12">
    @include('guide.field', ['id' => 'reflectionsPerson' . $index, 'inputType' => 'text',
    'labelText' => 'Person #' . $index, 'placeholder' => null])
</div>
@endforeach

@endsection
