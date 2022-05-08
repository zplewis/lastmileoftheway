@include('summary.included', ['htmlId' => $question->optional_html_id])

@if(strcasecmp(session($question->optional_html_id), 'yes') === 0)

<p>People to give reflections:</p>
<ul>
@foreach (range(1, session(\App\Http\Controllers\SubmissionController::NUM_REFLECTIONS_PERSONS, 2)) as $index)
    @continue(!session('reflectionsPerson' . $index) || trim(session('reflectionsPerson' . $index)) === '')

    <li>{{ session('reflectionsPerson' . $index) }}</li>
@endforeach
</ul>
@endif
