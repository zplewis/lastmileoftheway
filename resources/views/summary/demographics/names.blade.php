@php
    $isUserIsDeceasedDecided = session()->has('userIsDeceased') && session('userIsDeceased');
    $isThisServiceForYou = 'Undecided';
    if ($isUserIsDeceasedDecided) {
        $isThisServiceForYou = $isUserIsDeceased ? 'Yes' : 'No';
    }
@endphp

<h5>Your Information</h5>
<p class="mb-0 {{ !session()->has('userFirstName') || !session('userFirstName') || !session('userLastName') ? 'text-danger' : '' }}">
     Name: {{ ucwords(session('userFirstName') . ' ' . session('userLastName')) ?? 'Missing' }}</p>
@include('summary.required', ['htmlId' => 'userEmail', 'desc' => 'Email:', 'defaultValue' => 'Missing'])

{{-- Did not use summary.required because we need the actual yes/no text and the session value is a number --}}
<p class="mb-0 {{ !$isUserIsDeceasedDecided ? 'text-danger' : '' }}">
    Are you planning this service for yourself? {{ $isThisServiceForYou }}
</p>

<h5 class="mt-2">Deceased Information</h5>
<p class="mb-0">Preferred Name: {{ session('deceasedPreferredName') }}</p>

@if (!$isUserIsDeceased)
<p class="{{ !session()->has('deceasedFirstName') || !session('deceasedFirstName') || !session('deceasedLastName') ? 'text-danger' : '' }}">Deceased First &amp; Last Name:{{ ucwords(session('deceasedFirstName') . ' ' . session('deceasedLastName')) ?? 'Missing' }}</p>
@endif
