<p class="{{ strcasecmp(session($htmlId), 'yes') !== 0 ? 'text-danger' : '' }}">Included in this service: {{ session($htmlId) ?? 'Undecided' }}</p>
