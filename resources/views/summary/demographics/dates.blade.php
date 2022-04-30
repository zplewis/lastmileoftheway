<p>Date of birth: {{ session('dateBirth') }}

@if (!$isUserIsDeceased)
<br />Date of passing away: {{ session('dateDeath') ?? 'N/A' }}
<br />Desired service date: {{ session('dateService') ?? 'N/A' }}
@endif
</p>
