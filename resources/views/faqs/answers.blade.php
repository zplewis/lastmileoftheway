<div class="col-12 col-md-9">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" class="scrollspy-example-2 px-2" tabindex="0">
        <h1>FAQs</h1>
        @foreach ($categories as $category)
        <h2 id="{{ Str::of($category->description)->slug('-') }}" class="display-6">{{ $category->description }}</h2>
            @foreach ($category->questions()->get() as $question)
                <h4>{{ $question->description }}</h4>
                <p>{!! $question->answer()->firstOrNew()->full_text !!}</p>
            @endforeach
        @endforeach
    </div>
</div>
