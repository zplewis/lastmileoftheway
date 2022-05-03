@include('summary.included', ['htmlId' => $question->optional_html_id])

@if(strcasecmp(session($question->optional_html_id), 'yes') === 0)
<p>Prayer of Comfort person: {{ session('prayerOfComfortPerson') ?? 'Undecided' }}</p>
@endif
