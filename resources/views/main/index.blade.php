@extends('template.base')

@section('content')
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h1 class="modal-title fs-5">Borrando CV</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">Estas a punto de eliminar este CV, ¿estás seguro?</div>
    <div class="modal-footer">
      <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cerrar</button>
      <button form="form-delete" type="submit" class="btn btn-danger">Eliminar CV</button>
    </div>
  </div></div>
</div>

<div class="row">
  @forelse($alumnos as $alumno)
    <div class="col-md-4 mb-3">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top"
             src="{{ route('alumnos.foto', $alumno) }}"
             onerror="this.src='{{ asset('assets/img/sin-foto.webp') }}';"
             alt="Foto de {{ $alumno->nombre }}">
        <div class="card-body">
          <h5 class="card-title">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h5>
          <p class="card-text">Teléfono: {{ $alumno->telefono }}</p>
          <p class="card-text">Email: {{ $alumno->correo }}</p>
          <p class="card-text">Nota Media: {{ $alumno->nota_media }}</p>
        </div>
        <div class="options ms-3 mb-3">
          <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-outline-success">Ver</a>
          <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-outline-info">Editar</a>
          <a data-href="{{ route('alumnos.destroy', $alumno->id) }}"
             class="btn btn-outline-danger"
             data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</a>
        </div>
      </div>
    </div>
  @empty
    <p class="text-center">No hay currículums registrados.</p>
  @endforelse
</div>

<form id="form-delete" action="" method="post">
  @csrf
  @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteModal"]');
  const formDelete    = document.getElementById('form-delete');

  deleteButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      formDelete.setAttribute('action', this.getAttribute('data-href'));
    });
  });
});
</script>
@endsection
