@include('summary.included', ['htmlId' => $question->optional_html_id])

@if(strcasecmp(session($question->optional_html_id), 'yes') === 0)
<p>Officiating minister: {{ session('callToWorshipMinister') ?? 'Undecided' }}</p>
@endif