<div class="col col-md-3">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold">Order of Service</span>
    </a>
    <ul class="list-unstyled ps-0">
        @php
            $questions = \App\Http\Controllers\SubmissionController::getQuestionsByServiceType(\App\Http\Controllers\SubmissionController::getSelectedServiceType());
        @endphp

        @foreach ($categories as $sidebarCategory)

        @php
            $isCurrentSection = $currentCategory->id === $sidebarCategory->id;

        @endphp
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded {{ $isCurrentSection ? '' : 'collapsed' }}"
            data-bs-toggle="collapse" data-bs-target="#{{ $sidebarCategory->uri }}-collapse"
            aria-expanded="{{ $isCurrentSection ? 'true' : 'false' }}">
              {{ $sidebarCategory->title }}
            </button>
            <div class="collapse {{ $isCurrentSection ? 'show' : '' }}" id="{{ $sidebarCategory->uri }}-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    @foreach ($questions->where('guide_category_id', $sidebarCategory->id) as $question)
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
    </ul>
  </div>
