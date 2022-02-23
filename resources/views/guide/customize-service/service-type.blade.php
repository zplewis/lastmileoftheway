@extends('guide.container')

@section('guide.content')

<div class="row row-cols-1 row-cols-md-3 my-3 text-center service-type-selector">
    <div class="col">
        <div class="card">
            <h5 class="card-header">Graveside</h5>
            <div class="card-body">
                <p class="lead service-card-summary">Service held outside at the burial site</p>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Suitable for smaller services</li>
                    <li>Great for social distancing</li>
                    <li>Weather-contingent</li>
                </ul>
                <input type="radio" class="btn-check" name="service-type-selection" id="service-type-graveside" autocomplete="off" />
                <label class="btn btn-outline-primary" for="service-type-graveside">Select this service</label>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col for a card -->
    <div class="col">
        <div class="card">
            <h5 class="card-header">Funeral</h5>
            <div class="card-body">
                <p class="lead service-card-summary">Service held in church or funeral home</p>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>What most people think of as a burial service</li>
                    <li>Capacity dependent upon venue</li>
                </ul>
                <input type="radio" class="btn-check" name="service-type-selection" id="service-type-funeral" autocomplete="off" />
                <label class="btn btn-outline-primary" for="service-type-funeral">Select this service</label>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col for a card -->
    <div class="col">
        <div class="card">
            <h5 class="card-header">Memorial</h5>
            <div class="card-body">
                <p class="lead service-card-summary">Service held when burial is not possible</p>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Most flexible concerning location</li>
                    <li>Tends to be a shorter service</li>
                    <li>Preaching optional</li>
                </ul>
                <input type="radio" class="btn-check" name="service-type-selection" id="service-type-memorial" autocomplete="off" />
                <label class="btn btn-outline-primary" for="service-type-memorial">Select this service</label>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col for a card -->
</div> <!-- /.row -->

@endsection
