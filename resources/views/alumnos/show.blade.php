@extends('template.base')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h3>
            <a href="{{ route('alumnos.index') }}" class="btn btn-outline-light btn-sm">Volver</a>
        </div>

        <div class="card-body">
            <div class="row align-items-start">
                <!-- Imagen -->
                <div class="col-md-3 text-center mb-4">
                    <img 
                        src="{{ $alumno->fotografia ? asset($alumno->fotografia) : asset('assets/img/sin-foto.webp') }}"
                        alt="Foto de {{ $alumno->nombre }}"
                        class="img-thumbnail"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;"
                        onerror="this.src='{{ asset('assets/img/sin-foto.webp') }}';">
                </div>

                <!-- Información personal -->
                <div class="col-md-9">
                    <h5 class="fw-bold">Información personal</h5>
                    <ul class="list-unstyled">
                        <li><strong>Nombre:</strong> {{ $alumno->nombre }}</li>
                        <li><strong>Apellidos:</strong> {{ $alumno->apellidos }}</li>
                        <li><strong>Teléfono:</strong> {{ $alumno->telefono }}</li>
                        <li><strong>Correo electrónico:</strong> {{ $alumno->correo }}</li>
                        <li><strong>Fecha de nacimiento:</strong> 
                            {{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d/m/Y') }}
                        </li>
                        <li><strong>Nota media:</strong> {{ $alumno->nota_media }}</li>
                    </ul>
                </div>
            </div>

            <hr>

            <!-- Experiencia -->
            <div class="mb-4">
                <h5 class="fw-bold">Experiencia</h5>
                <p>{{ $alumno->experiencia ? $alumno->experiencia : 'No especificada.' }}</p>
            </div>

            <!-- Formación -->
            <div class="mb-4">
                <h5 class="fw-bold">Formación</h5>
                <p>{{ $alumno->formacion ? $alumno->formacion : 'No especificada.' }}</p>
            </div>

            <!-- Habilidades -->
            <div class="mb-4">
                <h5 class="fw-bold">Habilidades</h5>
                <p>{{ $alumno->habilidades ? $alumno->habilidades : 'No especificadas.' }}</p>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este alumno?')">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
