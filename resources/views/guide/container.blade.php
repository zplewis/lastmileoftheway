<div class="col-12 col-md-9">
    <div class="row me-1">
        <h4 class="mb-3">{!! $pageDesc !!}</h4>
        @if ($lead)
            <p class="lead">{!! $lead !!}</p>
        @endif

        <!-- Display any validation errors if they are present. This will be handled better in the future. -->
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/{{ request()->path() }}" method="POST">
            @csrf

            @include('guide.field', ['inputType' => 'hidden', 'id' => 'next-page', 'value' => 'guide/' . $next])
            <div class="row g-3">

                @yield('guide.content')

                <div class="col-12">
                    <!-- Add code here so that Next if there is a "next page" specified,
                    otherwise, use Submit for the button text. -->
                    <button type="submit" id="guide-advance" name="guide-advance" class="btn btn-primary">
                        {{ !$next ? 'Submit' : 'Save & Continue' }}
                    </button>
                </div> <!-- /.col-12 -->
            </div> <!-- /.row g-3 -->
        </form>
    </div> <!-- /.row me-1 -->
</div> <!-- /.col-12 col-md-9 -->
