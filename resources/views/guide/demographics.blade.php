<div class="col-12 col-md-9">
    <div class="row me-1">
        <h4 class="mb-3">Your Name &amp; Name of Deceased</h4>
        <form action="/guide/demographics" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="userFirstName" class="form-label">First name</label>
                    <input type="text" class="form-control" id="userFirstName" value="{{ old('userFirstName') }}" />
                </div>
                <div class="col-sm-6">
                    <label for="userLastName" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="userLastName" value="{{ old('userLastName') }}" />
                </div>
                <div class="col-12">
                    <label for="userEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="userEmail" value="{{ old('userEmail') }}" />
                </div>
                <div class="col-12">
                    <label for="userIsDeceased" class="form-label">Are you planning a service
                        for yourself?
                    </label>
                    <select class="form-select" id="userIsDeceased" aria-label="Is user planning for themselves?">
                        <option {{ !old('userIsDeceased') ? 'selected' : '' }}>Choose one</option>
                        <!-- This needs to be populated from the database for data consistency -->
                        <option value="0">No, I am planning a service for someone else</option>
                        <option value="1">Yes, I am planning a service for myself</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="deceasedFirstName" class="form-label">Deceased First name</label>
                    <input type="text" class="form-control" id="deceasedFirstName" />
                </div>
                <div class="col-sm-6">
                    <label for="deceasedLastName" class="form-label">Deceased Last name</label>
                    <input type="text" class="form-control" id="deceasedLastName" />
                </div>
                <div class="col-12">
                    <label for="deceasedDisplayName" class="form-label">Deceased Display name</label>
                    <input type="text" class="form-control" id="deceasedDisplayName" />
                </div>
                <div class="col-12">
                    <button type="submit"
                    <a href="" class="btn btn-primary">Next</a>
                </div>
            </div> <!-- /.row -->
        </form>
    </div>
</div>



</div>
