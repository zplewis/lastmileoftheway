<p class="{{ !session()->has('invocationMinister') || !session('invocationMinister') ? 'text-danger' : '' }}">Person for opening prayer: {{ session('invocationMinister') ?? 'Undecided' }}</p>
