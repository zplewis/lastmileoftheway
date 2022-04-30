<p class="{{ strcasecmp(session('hasCallToWorship'), 'no') === 0 ? 'text-danger' : '' }}">Included in this service: {{ session('hasCallToWorship') ?? 'Yes' }}</p>

@if(strcasecmp(session('hasCallToWorship'), 'no') !== 0)
<p>Officiating minister: {{ session('callToWorshipMinister') ?? 'N/A' }}</p>
@endif
