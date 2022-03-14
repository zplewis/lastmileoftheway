<div class="col col-md-3">
    <nav id="navbar-example3" class="navbar navbar-light bg-light flex-column align-items-stretch p-3 sticky-top">

        <div class="row">
            @foreach ($testaments as $testament)
                <div class="col-12">
                    <a class="nav-link" href="#{{ Str::of($testament->name . '-testament')->slug('-') }}" title="{{ $testament->name }} Testament">{{ ucwords($testament->name) }} Testament Readings</a>
                </div>
            @endforeach

            <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                <span class="fs-5 fw-semibold">Scripture Readings</span>
              </a>
              <ul class="list-unstyled ps-0">
                <li class="mb-1">
                  <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                    Old Testament Readings
                  </button>
                  <div class="collapse" id="home-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      <li><a href="#" class="link-dark rounded">Overview</a></li>
                      <li><a href="#" class="link-dark rounded">Updates</a></li>
                      <li><a href="#" class="link-dark rounded">Reports</a></li>
                    </ul>
                  </div>
                </li>
                <li class="mb-1">
                  <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    New Testament Readings
                  </button>
                  <div class="collapse" id="dashboard-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      <li><a href="#" class="link-dark rounded">Overview</a></li>
                      <li><a href="#" class="link-dark rounded">Weekly</a></li>
                      <li><a href="#" class="link-dark rounded">Monthly</a></li>
                      <li><a href="#" class="link-dark rounded">Annually</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
        </div>
    </nav> <!-- #navbar-example3 -->
</div>
