<div class="col col-md-3">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold">Order of Service Guide</span>
    </a>
    <ul class="list-unstyled ps-0">
        @php
            $questions = \App\Http\Controllers\SubmissionController::getQuestionsByServiceType($currentServiceType);
        @endphp

        @foreach ($categories as $sidebarCategory)

        @php
            $isCurrentSection = $currentCategory->id === $sidebarCategory->id;

        @endphp
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded text-start {{ $isCurrentSection ? '' : 'collapsed' }}"
            data-bs-toggle="collapse" data-bs-target="#{{ $sidebarCategory->uri }}-collapse"
            aria-expanded="{{ $isCurrentSection ? 'true' : 'false' }}">
              {{ $sidebarCategory->title }} {{ isset($currentServiceType) && strcasecmp($sidebarCategory->uri, 'personalize-service') === 0 ? '(' . $currentServiceType->title . ')' : '' }}
            </button>
            <div class="collapse {{ $isCurrentSection ? 'show' : '' }}" id="{{ $sidebarCategory->uri }}-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    @foreach ($questions->where('guide_category_id', $sidebarCategory->id) as $question)
                        {{-- Skip the "venue location" question if no service type have been selected yet,
                        as "Venue and Viewing Locations" supercedes this question --}}
                        @continue($currentServiceType === null && strcasecmp($question->uri, 'venue') === 0)

                        <li>
                            <!-- Highlight the current page in black -->
                            <a href="/{{ $question->pageUri() }}"
                        class="{{ strcasecmp(request()->path(), $question->pageUri()) === 0 ? 'link-dark' : 'link-secondary' }} rounded">
                        {!! $question->title !!}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </li>
        @endforeach
        <li class="my-2 ms-2">
            <form action="/guide/reset/all" method="POST" id="guide-reset-form" novalidate>
                @csrf
                <button type="submit" id="hard-reset" class="btn btn-danger btn-sm">Reset Order of Service</button>
            </form>
        </li>
    </ul>
  </div>
