<p>Date of birth: {{ session('dateBirth') }}

@if (!$userIsDeceased)
<br />Date of passing away: {{ session('dateDeath') }}
<br />Desired service date: {{ session('dateService') }}
@endif
</p>
