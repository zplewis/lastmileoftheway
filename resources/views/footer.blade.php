

<footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="{{ url('about') }}" class="nav-link px-2 text-muted">About</a></li>
      <li class="nav-item"><a href="{{ url('faqs') }}" class="nav-link px-2 text-muted">FAQs</a></li>
      <li class="nav-item"><a href="{{ url('glossary') }}" class="nav-link px-2 text-muted">Glossary</a></li>
      <li class="nav-item"><a href="{{ url('support') }}" class="nav-link px-2 text-muted">Support</a></li>
    </ul>
    <ul class="nav justify-content-center list-unstyled d-flex mb-4">
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
    </ul>
    <div class="text-center">
        <img src="{{ asset('images/leaf-logo-1.png') }}" class="header-leaf-logo" />
        <p class="text-center text-muted">&copy; 2021-{{ now()->format('Y') }} Last Mile of the Way, Inc</p>
    </div>

  </footer>
