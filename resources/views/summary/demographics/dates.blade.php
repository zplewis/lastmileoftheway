<p>Date of birth: {{ session('dateBirth') }}

@if (!$isUserIsDeceased)
<br />Date of passing away: {{ session('dateDeath') }}
<br />Desired service date: {{ session('dateService') }}
@endif
</p>
