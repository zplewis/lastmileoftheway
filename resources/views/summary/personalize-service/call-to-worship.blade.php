@include('summary.included', ['htmlId' => 'hasCallToWorship'])

@if(strcasecmp(session('hasCallToWorship'), 'yes') === 0)
<p>Officiating minister: {{ session('callToWorshipMinister') ?? 'Undecided' }}</p>
@endif
