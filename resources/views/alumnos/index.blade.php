@extends('layouts.app')
@section('title','Listado de CVs')

@section('content')
<div class="row g-4">
  @forelse($alumnos as $a)
  <div class="col-12 col-md-6 col-lg-4">
    <div class="card h-100">
      @if($a->fotografia)
  <img
  src="{{ asset('assets/img/' . $a->fotografia) }}"
  class="card-img-top"
  alt="Foto de {{ $a->nombre }}"
  style="height:160px;object-fit:cover;"
>

@else
  <div class="card-img-top bg-light" style="height:160px;"></div>
@endif
      <div class="card-body">
        <h5 class="card-title">{{ $a->nombre }} {{ $a->apellidos }}</h5>
        <p class="card-text small text-muted mb-2">Experiencia: {{ $a->experiencia ?? '-' }}</p>
        <p class="card-text" style="max-height:3.5rem;overflow:hidden;">
          {{ Str::limit($a->experiencia, 120) }}
        </p>
        <a href="{{ route('alumnos.show',$a) }}" class="btn btn-outline-primary btn-sm">View</a>
        <a href="{{ route('alumnos.edit',$a) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
        <form action="{{ route('alumnos.destroy', $a) }}"
      method="POST" class="d-inline"
      onsubmit="return confirm('¿Seguro que quieres eliminar este CV? Esta acción no se puede deshacer.');">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
</form>

      </div>
    </div>
  </div>
  @empty
    <p style="color: black;">No hay alumnos.</p>
  @endforelse
</div>

<div class="mt-4">{{ $alumnos->links() }}</div>
@endsection
