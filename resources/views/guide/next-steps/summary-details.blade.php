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
            <!-- highlight the question name in red if there are incomplete required questions -->
            <h4 class="mb-1 {{ $isIncomplete ? 'text-danger' : '' }}">{{ $question->title }}</h4>

            @if(!$isPreview)
                <a class="btn btn-primary" title="Edit" href="/guide/{{ $questionCategoryUri }}/{{ $question->uri }}">Edit</a>
            @endif

        </div>
        <div class="mb-1"> <!-- beginning of question content -->
            @includeIf(
                'summary.' . $questionCategoryUri . '.' . $question->uri,
                [
                    'isUserIsDeceased' => $isUserIsDeceased,
                    'question' => $question
                ]
            )
        </div> <!-- end of question content -->
      </li>
    @endforeach

  </ul>

@endforeach
