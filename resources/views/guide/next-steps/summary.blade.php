@extends('guide.container')

@section('guide.content')

@php
    $categories =  \App\Models\GuideCategory::whereIn('uri', ['demographics', 'service-type', 'personalize-service'])->get();
    $categoryIds = $categories->pluck('id');
    $userIsDeceased = strcasecmp(\App\Models\UserType::where('title', 'like', '%self%')->first()->id, session('userIsDeceased')) === 0;
    $selectAServiceQuestion = \App\Models\GuideQuestion::where('uri', 'selected-service')->first();
    $selectAServiceCategory = \App\Models\GuideCategory::where('id', $selectAServiceQuestion->guide_category_id)->first();
@endphp

@foreach ($categories as $category)

<h3>{{ strcasecmp($category->uri, 'personalize-service') === 0 ? 'Personalized Order of Service' : $category->title }}</h3>

<ul class="list-group">
    {{-- <!-- service type comes first -->
    <li class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Service Type</h5>
            <a class="btn btn-primary" title="Edit" href="/guide/{{ $selectAServiceCategory->uri }}/{{ $selectAServiceQuestion->uri }}">Edit</a>
        </div>
        <p class="mb-1">
            @includeIf(
                'summary.' . $selectAServiceCategory->uri . '.' . $selectAServiceQuestion->uri,
                [
                    'userIsDeceased' => $userIsDeceased
                ]
            )
        </p>
      </li> --}}

    <!-- loop through questions for demographic and personalize-service categories, -->
    @foreach (\App\Http\Controllers\SubmissionController::getQuestionsByServiceType($currentServiceType)->whereIn('guide_category_id', $category->id) as $question)
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

@endforeach

@endsection
