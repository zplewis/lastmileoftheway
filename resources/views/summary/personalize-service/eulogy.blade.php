@include('summary.included', ['htmlId' => $question->optional_html_id])

@if(strcasecmp(session($question->optional_html_id), 'yes') === 0)
<p>Sermon Minister: {{ session('eulogyMinister') ?? 'Undecided' }}</p>

<p>Sermon type: {{ \App\Models\SermonType::find(session('eulogyType'))->title }}</p>
@endif
