@extends('layouts.app')
@section('title', $alumno->nombre)

@section('content')
<div class="row">
  <div class="col-md-4">
    @if($alumno->fotografia)
      <img class="img-fluid rounded" src="{{ Storage::url($alumno->fotografia) }}">
    @endif
  </div>
  <div class="col-md-8">
    <h3>{{ $alumno->nombre }} {{ $alumno->apellidos }}</h3>
    <p><strong>Correo:</strong> {{ $alumno->correo }}</p>
    <p><strong>Teléfono:</strong> {{ $alumno->telefono }}</p>
    <p><strong>Fecha nacimiento:</strong> {{ $alumno->fecha_nacimiento }}</p>
    <p><strong>Nota media:</strong> {{ $alumno->nota_media }}</p>
    <hr>
    <p><strong>Formación:</strong><br>{!! nl2br(e($alumno->formacion)) !!}</p>
    <p><strong>Experiencia:</strong><br>{!! nl2br(e($alumno->experiencia)) !!}</p>
    <p><strong>Habilidades:</strong><br>{!! nl2br(e($alumno->habilidades)) !!}</p>
    <a class="btn btn-secondary" href="{{ route('alumnos.edit',$alumno) }}">Edit</a>
  </div>
</div>
@endsection
