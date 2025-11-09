@extends('layouts.app')
@section('title', $alumno->nombre)

@section('content')
<div class="row g-4">
  <div class="col-md-4">
    @if($alumno->fotografia)
      <img
        src="{{ asset(str_starts_with($alumno->fotografia, 'assets/')
                ? $alumno->fotografia
                : 'assets/img/'.$alumno->fotografia) }}"
        alt="Foto de {{ $alumno->nombre }}"
        class="img-fluid rounded"
        style="height:260px;object-fit:cover;width:100%;">
    @else
      <div class="bg-light rounded" style="height:260px;"></div>
    @endif
  </div>

  <div class="col-md-8">
    <h3 class="mb-3">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h3>

    <dl class="row">
      <dt class="col-sm-4">Correo</dt>
      <dd class="col-sm-8">{{ $alumno->correo }}</dd>

      <dt class="col-sm-4">Teléfono</dt>
      <dd class="col-sm-8">{{ $alumno->telefono ?? '—' }}</dd>

      <dt class="col-sm-4">Fecha nacimiento</dt>
      <dd class="col-sm-8">{{ $alumno->fecha_nacimiento ?? '—' }}</dd>

      <dt class="col-sm-4">Nota media</dt>
      <dd class="col-sm-8">{{ $alumno->nota_media ?? '—' }}</dd>

      <dt class="col-sm-4">Experiencia</dt>
      <dd class="col-sm-8">{{ $alumno->experiencia ?? '—' }}</dd>

      <dt class="col-sm-4">Formación</dt>
      <dd class="col-sm-8">{{ $alumno->formacion ?? '—' }}</dd>

      <dt class="col-sm-4">Habilidades</dt>
      <dd class="col-sm-8">{{ $alumno->habilidades ?? '—' }}</dd>
    </dl>

    <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-primary me-2">Edit</a>

    <form action="{{ route('alumnos.destroy', $alumno) }}"
          method="POST" class="d-inline"
          onsubmit="return confirm('¿Seguro que quieres eliminar este CV? Esta acción no se puede deshacer.');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <a href="{{ route('alumnos.index') }}" class="btn btn-link ms-2">Volver</a>
  </div>
</div>
@endsection
