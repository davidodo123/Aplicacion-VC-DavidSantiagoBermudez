<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'CVs Manager')</title>
  <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('main.index') }}">@yield('navbar', 'CVs Manager')</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="{{ route('alumnos.create') }}">Añadir CV</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('alumnos.index') }}">Ver CVs</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-4">
    @error('general')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @if(session('general'))
      <div class="alert alert-success">{{ session('general') }}</div>
    @endif

    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @yield('scripts')
</body>
</html>
