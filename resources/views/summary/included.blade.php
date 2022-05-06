@php
    $includedText = 'Undecided';
    if (session($htmlId)) {
        $includedText = ucwords(session($htmlId));
    }
@endphp
<p class="{{ !session()->has($htmlId) || !session($htmlId) ? 'text-danger' : '' }}">Included in this service: {{ $includedText }}</p>
