@include('summary.included', ['htmlId' => $question->optional_html_id])

@if(session()->has($question->optional_html_id) && strcasecmp(session($question->optional_html_id), 'yes') === 0)

    @include('summary.required', ['htmlId' => 'obituaryReading', 'desc' => 'Include a reading of the obituary', 'defaultValue' => 'Undecided'])

    @if(strcasecmp(session($question->optional_html_id), 'yes') === 0)
    <p>Designated person: {{ session('acknowledgementsPerson') ?? 'Undecided' }}</p>
    @endif

@endif
