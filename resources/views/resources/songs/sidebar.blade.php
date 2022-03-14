<div class="col col-md-3">
    <nav id="navbar-example3" class="navbar navbar-light bg-light flex-column align-items-stretch p-3 sticky-top">

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search FAQs" aria-label="Search FAQs" aria-describedby="button-addon2" />
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
        </div>

        <div class="row">
            @foreach ($songTypes as $songType)
                <div class="col-3">
                    <a class="nav-link" href="#{{ Str::of($songType->name)->slug('-') }}s" title="{{ $songType->name }}s">{{ $songType->name }}s</a>
                </div>
            @endforeach
        </div>
    </nav> <!-- #navbar-example3 -->
</div>
