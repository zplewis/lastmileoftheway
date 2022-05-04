@if (!$submissionComplete)
    <div class="alert alert-danger" role="alert">
        @if(!request()->is('guide/next-steps/summary'))
            Your order of service is incomplete. Please <a href="/guide/summary">click here</a>
            to review your selections.
        @elseif ($currentServiceType === null)
            Your order of service is incomplete. Please <a href="/guide/service-type">click here</a>
            to select a service type and answer any incomplete questions or the link below:<br />

            <a href="/guide/service-type" title="Select a service type">Select a service type for the service</a>
        @else
            Your order of service is incomplete. Please review your selections below and answer any
            incomplete questions. Incomplete sections are highlighted in <strong>red</strong> below.

            {{-- <ul class="list-unstyled mt-0 mb-2">
            @foreach ($incompleteQuestions as $question)
                <li>{{ $question->title }}</li>
            @endforeach
            </ul> --}}
        @endif

    </div>
@endif
