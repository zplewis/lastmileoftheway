@if (isset($currentServiceType))
    <p>{{ $currentServiceType->title }}</p>
@else
    <p class="text-danger">Unselected; please click <strong>Edit</strong> to choose a service type.</p>
@endif
