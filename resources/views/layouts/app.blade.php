<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title','CVs')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('alumnos.index') }}">CVs</a>
    <a class="btn btn-success" href="{{ route('alumnos.create') }}">Add entry</a>
  </div>
</nav>
<div class="container">@yield('content')</div>
</body>
</html>
