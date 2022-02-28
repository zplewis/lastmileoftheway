<nav class="py-2 border-bottom bg-charcoal">
    <div class="container d-flex flex-wrap justify-content-center">
      <ul class="nav">
        <li class="text-center">
            <!-- https://icons.getbootstrap.com/icons/info-circle-fill/ -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
              </svg>
            Not sure where to start? Get started planning your service <a href="/guide">here</a>.
        </li>
      </ul>
    </div>
  </nav>
  <header>
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center py-3 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="{{ asset('images/leaf-logo-1.png') }}" class="header-leaf-logo mx-2"></img>
        <span class="fs-4">Last Mile of the Way</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="px-3 nav-link dropdown-toggle link-dark" href="{{ url('about/') }}" title="about" id="about-dropdown"
        role="button" data-bs-toggle="dropdown" aria-expanded="false">About
        </a>
        <ul class="dropdown-menu" aria-labelledby="about-dropdown">
            <li><a class="dropdown-item" href="{{ url('about/') }}">About this site</a></li>
            <li><a class="dropdown-item" href="{{ url('about#about-pastor-farrow') }}">About Pastor Farrow</a></li>
            <li><a class="dropdown-item" href="{{ url('about#why-lastmileoftheway') }}">Why Last Mile of the Way?</a></li>
            <li><a class="dropdown-item" href="{{ url('about#attributions') }}">Attributions</a></li>
          </ul>

        <a class="me-2 py-2 text-dark text-decoration-none" href="{{ url('faqs/') }}">FAQs</a>

        <a class="px-3 nav-link dropdown-toggle link-dark" href="{{ url('resources/') }}" title="Resources"
        id="support-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Resources
        </a>
        <ul class="dropdown-menu" aria-labelledby="support-dropdown">
        <li><a class="dropdown-item" href="{{ url('glossary/') }}">Glossary</a></li>
            <li><a class="dropdown-item" href="{{ url('resources/songs') }}">Solos, hymns, and songs</a></li>
            <li><a class="dropdown-item" href="{{ url('resources/bible-readings') }}">Scripture Readings</a></li>
        </ul>

        <a class="px-0 nav-link dropdown-toggle link-dark" href="{{ url('support/') }}" title="support"
        id="support-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Support
        </a>
        <ul class="dropdown-menu" aria-labelledby="support-dropdown">
            <li><a class="dropdown-item" href="{{ url('support#contact-us') }}">Contact us / send feedback</a></li>
            <li><a class="dropdown-item" href="{{ url('support#request-appt') }}">Request an appointment</a></li>
          </ul>
      </nav>
    </div>
  </header>
