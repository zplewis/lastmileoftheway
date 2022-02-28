@extends('layout')


@section('content')
<div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold">We are here to help.</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Our goal is to help the process of planning the service a bit easier,
          so if something is not clear, you may find the answer in the
          <a href="{{ url('glossary') }}" title="Glossary">glossary</a> or
          <a href="{{ url('faqs') }}" title="FAQs">FAQs</a>. Still have questions? Feel free to
          use the form below to send your question. See how this site can make the planning process easier? Send us
          some feedback. Need more assistance? This site offers appointments for 1-on-1 consultations. We are here to help.</p>
    </div>
  </div>

  <!-- contact form -->
  <div class="container col-xl-10 col-xxl-8 px-4 py-5 bg-light">
    <h4 class="mb-3">Contact form</h4>

    <p class="lead">Whether your have questions, feedback, or both, feel free to reach out to
        us by completing this form. If you prefer email, you can also send a message to
        <a href="mailto:support@lastmileoftheway.com" title="support@lastmileoftheway.com" target="_blank">
            support@lastmileoftheway.com
        </a>.
    </p>

    <form class="rounded-3">
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="user-first" class="form-label">First name</label>
                <input type="text" class="form-control" id="user-first" required />
            </div>
            <div class="col-sm-6">
                <label for="user-last" class="form-label">Last name</label>
                <input type="text" class="form-control" id="user-last" required />
            </div>
            <div class="col-12">
                <label for="user-email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="user-email" required />
            </div>
            <div class="col-12">
                <label for="user-phone" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="user-phone" required />
            </div>
            <div class="col-12">
                <label for="contact-message" class="form-label">Your message for us</label>
                <textarea class="form-control" id="contact-message" rows="5" required></textarea>
            </div>
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="request-appt" />
                    <label class="form-check-label" for="request-appt">Check this box if you would
                        like to request a 15-minute 1-on-1 consultation for more assistance. <i>
                            Please note that you must have a completed order of service in order to
                            request a consultation.
                        </i>
                    </label>
                </div>
            </div>
            <div class="col-12 d-none" id="div-appointment-type">
                @include('guide.select', ['id' => 'contactApptType', 'labelText' => 'Appointment Type', 'collection' => \App\Models\ApptType::orderBy('name')->get(), 'textProp' => 'name'])
            </div>
            <div class="col-12">
                <button class="w-100 btn btn-lg btn-primary" type="submit">Send Message</button>
                <hr class="my-4">
            </div>
        </div> <!-- /.row -->
    </form>
  </div>
@endsection
