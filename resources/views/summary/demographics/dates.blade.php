@include('summary.required', ['htmlId' => 'dateBirth', 'desc' => 'Date of birth:', 'defaultValue' => 'Missing'])

<p>
@if (!$isUserIsDeceased)
<br />Date of passing away: {{ session('dateDeath') ?? 'N/A' }}
<br />Desired service date: {{ session('dateService') ?? 'Undecided' }}
@endif
</p>
