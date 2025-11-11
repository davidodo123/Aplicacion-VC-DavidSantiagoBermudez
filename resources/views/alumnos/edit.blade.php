@extends('template.base')

@section('content')
<form action="{{ route('alumnos.update', $alumno->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('put')

  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre:</label>
    <input type="text" class="form-control" id="nombre" name="nombre" maxlength="20" value="{{ old('nombre', $alumno->nombre) }}" required>
  </div>

  <div class="mb-3">
    <label for="apellidos" class="form-label">Apellidos:</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="60" value="{{ old('apellidos', $alumno->apellidos) }}" required>
  </div>

  <div class="mb-3">
    <label for="telefono" class="form-label">Teléfono:</label>
    <input type="tel" class="form-control" id="telefono" name="telefono" maxlength="20" value="{{ old('telefono', $alumno->telefono) }}" required>
  </div>

  <div class="mb-3">
    <label for="correo" class="form-label">Dirección de correo:</label>
    <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $alumno->correo) }}" required>
  </div>

  <div class="mb-3">
    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', optional($alumno->fecha_nacimiento)->format('Y-m-d')) }}" required>
  </div>

  <div class="mb-3">
    <label for="nota_media" class="form-label">Nota media:</label>
    <input type="number" class="form-control" id="nota_media" name="nota_media" min="0" max="10" step="0.1" value="{{ old('nota_media', $alumno->nota_media) }}" required>
  </div>

  <div class="mb-3">
    <label for="experiencia" class="form-label">Experiencia:</label>
    <textarea class="form-control" id="experiencia" name="experiencia">{{ old('experiencia', $alumno->experiencia) }}</textarea>
  </div>

  <div class="mb-3">
    <label for="formacion" class="form-label">Formación:</label>
    <textarea class="form-control" id="formacion" name="formacion">{{ old('formacion', $alumno->formacion) }}</textarea>
  </div>

  <div class="mb-3">
    <label for="habilidades" class="form-label">Habilidades:</label>
    <textarea class="form-control" id="habilidades" name="habilidades">{{ old('habilidades', $alumno->habilidades) }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label d-block">Foto actual:</label>
    @if($alumno->fotografia)
      <img src="{{ route('alumnos.foto', $alumno) }}" alt="Foto actual" width="150" class="mb-2"
           onerror="this.src='{{ asset('assets/img/sin-foto.webp') }}';">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remove_image" name="remove_image" value="1">
        <label class="form-check-label" for="remove_image">Eliminar foto actual</label>
      </div>
    @else
      <p>No hay foto subida.</p>
    @endif
  </div>

  <div class="mb-3">
    <label for="image" class="form-label">Cambiar foto:</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
    <small class="form-text text-muted">Si seleccionas una nueva imagen, reemplazará la actual.</small>
  </div>

  <button type="submit" class="btn btn-primary">Editar</button>
</form>
@endsection
