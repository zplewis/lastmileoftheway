



    <div class="row row-cols-1 row-cols-md-3 my-3 text-center service-type-selector">
        @foreach (\App\Models\ServiceType::all() as $serviceType)

        <div class="col">
            <div class="card">
                <h5 class="card-header py-3 {{ strcasecmp(session('service-type-selection'), 'service-type-' . $serviceType->titleLower()) === 0 ? 'text-white bg-primary border-primary' : ''}}">
                    {{ $serviceType->title }}
                </h5>
                <div class="card-body">
                    <p class="lead service-card-summary">{{ $serviceType->description }}</p>
                    <ul class="list-unstyled mt-3 mb-4">
                        @foreach (explode(',', $serviceType->bullet_points) as $point)
                            <li>{!! $point !!}</li>
                        @endforeach
                    </ul>

                    @section('service_button')
                        <a href="/guide/?service={{ strtolower($serviceType->title) }}" title="Get started with a {{ $serviceType->title }} service"
                            role="button" class="w-100 btn btn-lg btn-outline-primary">Get started</a>
                    @endsection

                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col for a card -->

        @endforeach
    </div> <!-- /.row -->
