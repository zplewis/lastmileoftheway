<h6>Your Information</h6>
<p class="mb-0 {{ !session()->has('userFirstName') || !session('userFirstName') || !session('userLastName') ? 'text-danger' : '' }}">Name:{{ (session('userFirstName') . ' ' . session('userLastName')) ?? 'Missing' }}</p>
@include('summary.required', ['htmlId' => 'userEmail', 'desc' => 'Email:', 'defaultValue' => 'Missing'])
@include('summary.required', ['htmlId' => 'userIsDeceased', 'desc' => 'Are you planning this service for yourself?', 'defaultValue' => 'Undecided'])

<h6 class="mt-2">Deceased Information</h6>
<p class="mb-0">Preferred Name: {{ session('deceasedPreferredName') }}</p>

@if (!$isUserIsDeceased)
<p class="{{ !session()->has('deceasedFirstName') || !session('deceasedFirstName') || !session('deceasedLastName') ? 'text-danger' : '' }}">Deceased First &amp; Last Name:{{ (session('deceasedFirstName') . ' ' . session('deceasedLastName')) ?? 'Missing' }}</p>
@endif
