<p class="mb-0 {{ !session()->has($htmlId) || !session($htmlId) ? 'text-danger' : '' }}">{{ $desc ?? 'Value:' }} {{ session($htmlId) ?? $defaultValue ?? 'Undecided' }}</p>
