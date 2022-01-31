<div class="col-12 col-md-9">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" class="scrollspy-example-2" tabindex="0">
        @foreach ($categories as $category)
        <p id="{{ Str::of($category->description)->slug('-') }}" class="display-6">{{ $category->description }}</p>
            @foreach ($category->questions()->get() as $question)
                <h4>{{ $question->description }}</h4>
                <p>{{ $question->answer()->firstOrNew()->full_text }}</p>
            @endforeach
        @endforeach
    </div>
</div>
