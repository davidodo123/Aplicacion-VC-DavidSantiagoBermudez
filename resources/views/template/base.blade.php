<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CVs Manager')</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- cache-busting simple --}}
    <link rel="stylesheet" href="{{ url('assets/css/styles.css?r=' . rand(1, 10000)) }}">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{ route('main.index') }}">@yield('navbar', 'CVs Manager')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('main.index') ? 'active' : '' }}"
                 href="{{ route('main.index') }}">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('alumnos.create') ? 'active' : '' }}"
                 href="{{ route('alumnos.create') }}">Añadir CV</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('alumnos.index') ? 'active' : '' }}"
                 href="{{ route('alumnos.index') }}">Ver CVs</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container my-5">
      {{-- mensajes de error/success --}}
      @error('general')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      @if(session('general'))
        <div class="alert alert-success">{{ session('general') }}</div>
      @endif

      @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    <script src="{{ url('assets/js/main.js?r=' . rand(1, 10000)) }}"></script>
  </body>
</html>
