<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','App')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  @php
    $cssPath = public_path('assets/css/styles.css');
    $v = file_exists($cssPath) ? filemtime($cssPath) : time(); 
  @endphp
  <link rel="stylesheet"
        href="{{ request()->getSchemeAndHttpHost() }}/laravel/VC/public/assets/css/styles.css?v={{ $v }}">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="{{ route('alumnos.index') }}">CV Manager</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('alumnos.index') ? 'active' : '' }}" href="{{ route('alumnos.index') }}">
              Home
            </a>
          </li>
          <li class="nav-item ms-2">
            <a class="btn btn-primary" href="{{ route('alumnos.create') }}">Add entry</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-4">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
