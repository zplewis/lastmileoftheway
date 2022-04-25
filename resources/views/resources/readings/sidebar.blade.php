<div class="col col-md-3">
    <nav id="navbar-example3" class="navbar navbar-light bg-light flex-column align-items-stretch p-3 sticky-top">

        <div class="row">

            <span class="fs-5 fw-semibold mb-3">Scripture Readings</span>

              <ul class="list-unstyled ps-0">
                @foreach ($testaments as $testament)
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" type="button"
                        data-bs-target="#{{ $testament->name }}-collapse" aria-expanded="false" aria-controls="#{{ $testament->name }}-collapse">
                            {{ ucwords($testament->name) }} Testament Readings
                        </button>
                        <div class="collapse" id="{{ $testament->name }}-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                @foreach (\App\Models\Scriptures::whereHas('bible_versions', function ($query) use ($bible_version) {
                                    $query->where('id', $bible_version->id);
                                })
                                ->whereHas('bible_book.testament', function ($query) use ($testament) {
                                    $query->where('name', $testament->name);
                                })->orderBy('title')->get()
                                 as $scripture)
                                    <li>
                                        <!-- the .nav-link CSS class is required for Scrollspy components to work properly -->
                                        <a href="#{{ Str::of($scripture->title)->slug('-') }}" class="nav-link link-secondary rounded" title="{{ $scripture->title }}">
                                            {{ $scripture->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div> <!-- ./collapse -->
                    </li> <!-- /.mb-1 -->
                @endforeach
              </ul>
        </div>
    </nav> <!-- #navbar-example3 -->
</div>
