<div class="col-12 col-md-9">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" class="scrollspy-example-2" tabindex="0">
        @foreach ($categories as $category)
        <h3 id="{{ Str::of($category . '-terms')->slug('-') }}">{{ $category }}</h3>
            @foreach ($definitions as $definition)
                @if (strtoupper($definition->term)[0] > $category)
                    @break
                @endif

                @if (strtoupper($definition->term)[0] < $category)
                    @continue
                @endif

                <p class="lead" id="{{ Str::of($definition->term)->slug('-') }}">{{ $definition->term }}</p>
                <p>{{ $definition->full_text }}
                    @if ($definition->similarTerms()->get())
                        <br />See
                        @foreach ($definition->similarTerms()->get()->pluck('term') as $term)
                            <a href="#{{ Str::of($term)->slug('-') }}" title="{{ $term }}">{{ $term }}</a>
                        @endforeach
                    @endif
                </p>

            @endforeach
        @endforeach
    </div>
</div>
