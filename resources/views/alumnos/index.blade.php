@extends('template.base')

@section('content')
<div class="container mt-4">
    <div class="row">
        @forelse($alumnos as $alumno)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <!-- Imagen del alumno -->
                        <img 
                            src="{{ $alumno->fotografia ? asset($alumno->fotografia) : asset('assets/img/sin-foto.webp') }}"
                            alt="Foto de {{ $alumno->nombre }}"
                            class="img-thumbnail mb-3"
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px;"
                            onerror="this.src='{{ asset('assets/img/sin-foto.webp') }}';">

                        <!-- Datos -->
                        <h5 class="card-title fw-bold">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h5>
                        <p class="card-text mb-1"><strong>Teléfono:</strong> {{ $alumno->telefono }}</p>
                        <p class="card-text mb-1"><strong>Correo:</strong><br>{{ $alumno->correo }}</p>
                        <p class="card-text"><strong>Nota media:</strong> {{ $alumno->nota_media }}</p>
                    </div>

                    <!-- Botones -->
                    <div class="card-footer bg-white border-0 d-flex justify-content-around">
                        <a href="{{ route('alumnos.show', $alumno) }}" class="text-success fw-bold">Ver</a>
                        <a href="{{ route('alumnos.edit', $alumno) }}" class="text-info fw-bold">Editar</a>
                        <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este alumno?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger fw-bold p-0 m-0">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center mt-4">No hay currículums registrados.</p>
        @endforelse
    </div>
</div>
@endsection
