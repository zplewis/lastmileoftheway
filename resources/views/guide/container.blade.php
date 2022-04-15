<div class="col-12 col-md-9">
    <div class="row">
        <h2 class="mb-3">{!! $currentQuestion->title !!}</h2>
        @if ($currentQuestion->description)
            <p class="lead">{!! $currentQuestion->description !!}</p>
        @endif

        <!-- Display any validation errors if they are present. This will be handled better in the future. -->
        @if ($errors->any() && strcasecmp($currentQuestion->uri, 'selected-service') === 0 || $errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- <p class="lead">Selected service type: {{ $currentServiceType ? $currentServiceType->name : NULL }}</p> --}}

        {{-- .needs-validation class used so that it's easier to target forms that need validation, even beyond #guide-form --}}
        {{-- https://getbootstrap.com/docs/5.1/forms/validation/ --}}
        {{-- <form action="/{{ request()->path() }}" method="POST" id="guide-form" novalidate class="needs-validation {{ $errors->any() ? 'was-validated' : '' }}"> --}}
        <form action="/{{ request()->path() }}" method="POST" id="guide-form" novalidate class="needs-validation">
            @csrf

            @include('guide.field', ['inputType' => 'hidden', 'id' => 'next-page', 'value' => $nextQuestionUri])
            <div class="row g-3">

                @if ($currentQuestion->optional_html_id)
                    @include('guide.switch', ['id' => $currentQuestion->optional_html_id, 'labelText' => $currentQuestion->optional ?? 'Include a ' . $currentQuestion->title . ' in this service'])
                @endif

                @yield('guide.content')

                <div class="col-12">
                    <!-- Add code here so that Next if there is a "next page" specified,
                    otherwise, use Submit for the button text. -->
                    <button type="submit" id="guide-advance" name="guide-advance" class="btn btn-primary">
                        @if ($currentQuestion->item_order === 1 && $currentCategory->item_order === 1)
                        Start
                        @else
                        {{ !$nextQuestion ? 'Submit' : 'Save & Continue' }}
                        @endif

                    </button>
                </div> <!-- /.col-12 -->
            </div> <!-- /.row g-3 -->
        </form>
    </div> <!-- /.row -->
</div> <!-- /.col-12 col-md-9 -->
