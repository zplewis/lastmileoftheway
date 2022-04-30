<h6>Your Information</h6>
<p>Name: {{ session('userFirstName') }} {{ session('userLastName') }}<br />
Email: {{ session('userEmail') }}<br />
<span class="{{ $isUserIsDeceased ? 'text-info' : '' }}">Are you planning this service for yourself? {{ $isUserIsDeceased ? 'YES' : 'NO' }}</span>
</p>

<h6>Deceased Information</h6>
<p>Preferred Name: {{ session('deceasedPreferredName') }}
@if (!$isUserIsDeceased)
<br />Name: {{ session('deceasedFirstName') }} {{ session('deceasedLastName') }}
@endif
</p>
