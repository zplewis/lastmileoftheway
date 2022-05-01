@extends('guide.container')

@section('guide.content')

{{-- https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/accept#limiting_accepted_file_types --}}
<div class="mb-3">
    <label for="deceasedBio" class="form-label">Upload a biography or other document for the deceased (PDF, Microsoft Word):</label>
    <input class="form-control" type="file" id="deceasedBio" accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
</div>

<h3>Email recipients</h3>
<p>Specify up to 5 addresses to send the order of service via email. If you need
    to send the order of service to additional people, on the left-hand side,
    click <strong>Next Steps</strong> -> <strong>Send Service via Email</strong>
    and try again.
</p>

@foreach (range(1, env('MAX_NUM_EMAIL_RECIPIENTS', 5)) as $index)
<div class="col-12">
    @include('guide.field', ['id' => 'recipientEmail' . $index, 'inputType' => 'email', 'labelText' => 'Email address #' . $index, 'required' => $loop->first])
</div>
@endforeach


@endsection
