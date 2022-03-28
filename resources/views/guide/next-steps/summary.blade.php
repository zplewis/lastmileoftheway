@extends('guide.container')

@section('guide.content')

@php
    $categories =  \App\Models\GuideCategory::whereIn('uri', ['demographics', 'personalize-service'])->get();
    $categoryIds = $categories->pluck('id');
    $userIsDeceased = strcasecmp(\App\Models\UserType::where('title', 'like', '%self%')->first()->id, session('userIsDeceased')) === 0;
@endphp

<ul class="list-group">
    <!-- loop through questions for demographic and personalize-service categories, -->
    @foreach (\App\Http\Controllers\SubmissionController::getQuestionsByServiceType(\App\Http\Controllers\SubmissionController::getSelectedServiceType())->whereIn('guide_category_id', $categoryIds)->whereNotIn('uri', ['service-type']) as $question)
    @php
        $questionCategoryUri = $categories->where('id', $question->guide_category_id)->first()->uri;
    @endphp
    <li class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $question->title }}</h5>
            <a class="btn btn-primary" title="Edit" href="/guide/{{ $questionCategoryUri }}/{{ $question->uri }}">Edit</a>
        </div>
        <p class="mb-1">
            @includeIf(
                'summary.' . $questionCategoryUri . '.' . $question->uri,
                [
                    'userIsDeceased' => $userIsDeceased
                ]
            )
        </p>
      </li>
    @endforeach

  </ul>

@endsection
