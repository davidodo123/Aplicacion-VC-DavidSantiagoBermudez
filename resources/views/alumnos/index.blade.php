@extends('layouts.app')
@section('title','Alumnos')

@section('content')
<div class="row g-4">
  @forelse($alumnos as $a)
  <div class="col-12 col-md-6 col-lg-4">
    <div class="card h-100">
      @if($a->fotografia)
        <img src="{{ Storage::url($a->fotografia) }}" class="card-img-top" alt="Foto">
      @else
        <div class="card-img-top bg-light" style="height:160px;"></div>
      @endif
      <div class="card-body">
        <h5 class="card-title">{{ $a->nombre }} {{ $a->apellidos }}</h5>
        <p class="card-text small text-muted mb-2">Nota media: {{ $a->nota_media ?? '-' }}</p>
        <p class="card-text" style="max-height:3.5rem;overflow:hidden;">
          {{ Str::limit($a->experiencia, 120) }}
        </p>
        <a href="{{ route('alumnos.show',$a) }}" class="btn btn-outline-primary btn-sm">View</a>
        <a href="{{ route('alumnos.edit',$a) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
      </div>
    </div>
  </div>
  @empty
    <p>No hay alumnos.</p>
  @endforelse
</div>

<div class="mt-4">{{ $alumnos->links() }}</div>
@endsection
