{{-- First page of the PDF  --}}
<div style="text-align: center; font-family: sans-serif">
    <img src="{{ request()->is('*/preview') ? asset('images/leaf-logo-1.png') : public_path('images/leaf-logo-1.png') }}" class="header-leaf-logo" alt="Last Mile of the Way logo"
        style="width: 500px" />
    <h1>Order of Service for {{ ucwords(session('deceasedPreferredName')) }}</h1>
    @if (!empty(session('dateService')))
        <h2>{{ session('dateService') }}</h2>
        {{-- <h2>{{ \Carbon\Carbon::createFromFormat('YYYY-MM-DD', session('dateService'))->format('l, F jS, Y') }}</h2> --}}
    @endif
    <h3>prepared by {{ ucwords(session('userFullName')) }} using Last Mile of the Way</h3>
    <p>
        <a href="{{ env('APP_URL') }}" class="text-decoration-none text-dark">
            https://lastmileoftheway.com
        </a>
    </p>
</div>

<div class="page-break" style="page-break-before: always"></div>

{{-- Second page of the PDF onwards starts here --}}
<div style="font-family: sans-serif">
@foreach ($categories =  \App\Models\GuideCategory::whereIn('uri', ['demographics', 'service-type', 'personalize-service'])->get() as $category)

<h1>{{ strcasecmp($category->uri, 'personalize-service') === 0 ? 'Personalized Order of Service' : $category->title }}</h1>

<div>

    <!-- loop through questions for demographic and personalize-service categories, -->
    @foreach (\App\Http\Controllers\SubmissionController::getQuestionsByServiceType($currentServiceType)->whereIn('guide_category_id', $category->id) as $question)
    @php
        $questionCategoryUri = $categories->where('id', $question->guide_category_id)->first()->uri;
        $isIncomplete = $incompleteQuestions->where('guide_category_id', $question->guide_category_id)->where('id', $question->id)->first() !== null;
    @endphp
    <div>
         <!-- highlight the question name in red if there are incomplete required questions -->
        <h2 class="mb-0 {{ $isIncomplete ? 'text-danger' : '' }}">{{ $question->title }}</h2>
        <div class="mb-1"> <!-- beginning of question content -->
            @includeIf(
                'summary.' . $questionCategoryUri . '.' . $question->uri,
                [
                    'isUserIsDeceased' => $isUserIsDeceased,
                    'question' => $question
                ]
            )
        </div> <!-- end of question content -->
      </div>
    @endforeach

    </div>

@endforeach
</div>
