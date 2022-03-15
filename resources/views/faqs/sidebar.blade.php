<div class="col col-md-3">
        <nav id="navbar-example3" class="navbar navbar-light bg-light flex-column align-items-stretch p-3 sticky-top">

            <ul class="btn-toggle-nav list-unstyled pb-1 ps-0">
                @foreach ($categories as $category)
                    <!-- https://laravel.com/docs/8.x/helpers#method-fluent-str-slug -->
                    <li class="mb-1">
                        <a class="rounded" href="#{{ Str::of($category->description)->slug('-') }}"
                        title="{{ $category->description }}">{{ $category->description }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div> <!-- /.col col-md-3 -->
