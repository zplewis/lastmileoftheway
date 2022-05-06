@include('summary.required', ['htmlId' => 'dateBirth', 'desc' => 'Date of birth:', 'defaultValue' => 'Missing'])

@if (!$isUserIsDeceased)
<p>
Date of passing away: {{ session('dateDeath') ?? 'N/A' }}
<br />Desired service date: {{ session('dateService') ?? 'Undecided' }}
</p>
@endif
