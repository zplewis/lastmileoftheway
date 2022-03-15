<div class="col-12 col-md-9">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" class="scrollspy-example-2" tabindex="0">

        <h1>Scripture Readings</h1>

        <p class="lead">It is common to read scriptures from both the Old and New testaments during
            the service. Here are some recommendations that can be used, but feel free to choose a
            scripture not listed here.
        </p>

        @foreach ($testaments as $testament)

            <h2>{{ ucwords($testament->name) }} Testament</h2>
            <hr />

            @foreach (\App\Models\Scriptures::whereHas('bible_versions', function ($query) use ($bible_version) {
                $query->where('id', $bible_version->id);
            })
            ->whereHas('bible_book.testament', function ($query) use ($testament) {
                $query->where('name', $testament->name);
            })->orderBy('title')->get()
            as $scripture)

            <h3 id="{{ Str::of($scripture->title)->slug('-') }}">{{ $scripture->title }}</h3>
            <figure>
                <blockquote class="blockquote">
                    {{ $scripture->verses }}
                </blockquote>
                <figcaption class="blockquote-footer">
                    {{ $scripture->location }} ({{ $scripture->bible_versions->name }})
                </figcaption>
            </figure>

            @endforeach
        @endforeach

    </div>
</div>
