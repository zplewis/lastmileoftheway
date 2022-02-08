<div class="col col-md-3">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold">Service Plan</span>
    </a>
    <ul class="list-unstyled ps-0">
        @foreach ($sections as $sidebarSection => $sidebarPages)

        @php
            $sectionText = ucwords(strtr($sidebarSection, '-', ' '));
            $isCurrentSection = strcasecmp($section, $sidebarSection) === 0;

        @endphp
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded {{ $isCurrentSection ? '' : 'collapsed' }}"
            data-bs-toggle="collapse" data-bs-target="#{{ $sidebarSection }}-collapse"
            aria-expanded="{{ $isCurrentSection ? 'true' : 'false' }}">
              {{ $sectionText }}
            </button>
            <div class="collapse {{ $isCurrentSection ? 'show' : '' }}" id="{{ $sidebarSection }}-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    @foreach ($sidebarPages as $sidebarPage => $sidebarPageDesc)
                        @php
                            $path = $sidebarSection;
                            if ($sidebarPage) {
                                $path .= '/' . $sidebarPage;
                            }
                        @endphp
                        <li><a href="/guide/{{ $path }}" class="link-dark rounded">{{ $sidebarPageDesc }}</a></li>
                    @endforeach

                </ul>
            </div>
        </li>
        @endforeach
    </ul>
  </div>
