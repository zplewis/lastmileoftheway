<h6>Your Information</h6>
<p>Name: {{ session('userFirstName') }} {{ session('userLastName') }}<br />
Email: {{ session('userEmail') }}<br />
<span class="{{ $userIsDeceased ? 'text-danger' : '' }}">Are you planning this service for yourself? {{ $userIsDeceased ? 'YES' : 'NO' }}</span>
</p>

<h6>Deceased Information</h6>
<p>Preferred Name: {{ session('deceasedPreferredName') }}
@if (!$userIsDeceased)
<br />Name: {{ session('deceasedFirstName') }} {{ session('deceasedLastName') }}
@endif
</p>
