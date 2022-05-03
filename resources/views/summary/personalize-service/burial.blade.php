@include('summary.included', ['htmlId' => $question->optional_html_id])

@if(strcasecmp(session($question->optional_html_id), 'yes') === 0)
<p>Burial is immediately following service: {{ session('isBurialAfterService') ?? 'Undecided' }}</p>
<p>Location for burial (if known): {{ session('burialLocation') ?? 'Undecided' }}</p>
@endif
