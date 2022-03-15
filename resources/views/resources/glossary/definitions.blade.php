<div class="col-12 col-md-9">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" class="scrollspy-example-2" tabindex="0">
        @foreach ($categories as $category)

        @php
            $numDefinitionsByLetter = 0;
        @endphp

            @foreach (\App\Models\Definitions::where('term', 'like', strtolower($category) . '%')->orderBy('term')->get() as $definition)

                {{-- Only print the letter if there is at least 1 term that starts with it --}}
                @if ($numDefinitionsByLetter === 0)
                    <h3 id="{{ Str::of($category . '-terms')->slug('-') }}">{{ $category }}</h3>
                    @php
                        $numDefinitionsByLetter++;
                    @endphp
                @endif

                <p class="lead" id="{{ $definition->slug() }}">{{ $definition->term }}</p>
                <p>
                    {!! $definition->full_text !!}
                    @if ($definition->similarTerms()->get()->count())See {!! $definition->similarTermsAsLinks() !!}.
                    @endif
                </p>

            @endforeach
        @endforeach
    </div>
</div>
