<div class="col col-md-3">
        <nav id="navbar-example3" class="navbar navbar-light bg-light flex-column align-items-stretch p-3 sticky-top">

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search FAQs" aria-label="Search FAQs" aria-describedby="button-addon2" />
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
              </div>

            <nav class="nav nav-pills flex-column">
                @foreach ($categories as $category)
                    <!-- https://laravel.com/docs/8.x/helpers#method-fluent-str-slug -->
                    <a class="nav-link" href="#{{ Str::of($category->description)->slug('-') }}"
                    title="{{ $category->description }}">{{ $category->description }}</a>
                @endforeach
            </nav>
        </nav>
    </div>
