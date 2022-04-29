@if (isset($currentServiceType))
    <p>{{ $currentServiceType->title }}</p>
@else
    <h6 class="text-danger">Unselected; please click <strong>Edit</strong> to choose a service type.</h6>
@endif
