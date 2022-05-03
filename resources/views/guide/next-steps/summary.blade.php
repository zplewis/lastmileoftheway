@extends('guide.container')

@section('guide.content')

@if (!$submissionComplete)
    <div class="alert alert-danger" role="alert">
        @if ($currentServiceType === null)
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

@php
    // $categories =  \App\Models\GuideCategory::whereIn('uri', ['demographics', 'service-type', 'personalize-service'])->get();
    // $categoryIds = $categories->pluck('id');
    // $selectAServiceQuestion = \App\Models\GuideQuestion::where('uri', 'selected-service')->first();
    // $selectAServiceCategory = \App\Models\GuideCategory::where('id', $selectAServiceQuestion->guide_category_id)->first();
@endphp

@foreach ($categories =  \App\Models\GuideCategory::whereIn('uri', ['demographics', 'service-type', 'personalize-service'])->get() as $category)

<h3>{{ strcasecmp($category->uri, 'personalize-service') === 0 ? 'Personalized Order of Service' : $category->title }}</h3>

<ul class="list-group">

    <!-- loop through questions for demographic and personalize-service categories, -->
    @foreach (\App\Http\Controllers\SubmissionController::getQuestionsByServiceType($currentServiceType)->whereIn('guide_category_id', $category->id) as $question)
    @php
        $questionCategoryUri = $categories->where('id', $question->guide_category_id)->first()->uri;
        $isIncomplete = $incompleteQuestions->where('guide_category_id', $question->guide_category_id)->where('id', $question->id)->first() !== null;
    @endphp
    <li class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 {{ $isIncomplete ? 'text-danger' : '' }}">{{ $question->title }}</h5>
            <a class="btn btn-primary" title="Edit" href="/guide/{{ $questionCategoryUri }}/{{ $question->uri }}">Edit</a>
        </div>
        <p class="mb-1">
            @includeIf(
                'summary.' . $questionCategoryUri . '.' . $question->uri,
                [
                    'isUserIsDeceased' => $isUserIsDeceased,
                    'question' => $question
                ]
            )
        </p>
      </li>
    @endforeach

  </ul>

@endforeach

@endsection
