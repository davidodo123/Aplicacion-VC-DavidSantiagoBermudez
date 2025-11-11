@extends('template.base')

@section('content')
<h3 class="mb-3">Añadir alumno</h3>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('alumnos.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Apellidos</label>
    <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Correo</label>
    <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Fecha de nacimiento</label>
    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Nota media</label>
    <input type="number" step="0.01" min="0" max="10" name="nota_media" class="form-control" value="{{ old('nota_media') }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Experiencia</label>
    <textarea name="experiencia" class="form-control" rows="3">{{ old('experiencia') }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Formación</label>
    <textarea name="formacion" class="form-control" rows="3">{{ old('formacion') }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Habilidades</label>
    <textarea name="habilidades" class="form-control" rows="2">{{ old('habilidades') }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Fotografía (opcional)</label>
    <input type="file" name="fotografia" class="form-control" accept="image/*">
  </div>

  <button class="btn btn-primary">Guardar</button>
  <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
