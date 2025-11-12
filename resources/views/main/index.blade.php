@extends('template.base')

@section('content')

{{-- Modal de confirmación de borrado --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Borrar CV</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        Estás a punto de eliminar este CV. ¿Seguro que quieres hacerlo?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  @forelse($alumnos as $alumno)
    <div class="col-md-4 mb-3">
      <div class="card" style="width: 18rem;">
        <img
          class="card-img-top"
          src="{{ route('alumnos.foto', $alumno->id) }}"
          alt="Foto de {{ $alumno->nombre }}"
          onerror="this.src='{{ asset('assets/img/sin-foto.webp') }}';"
        >
        <div class="card-body">
          <h5 class="card-title">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h5>
          <p class="card-text">Teléfono: {{ $alumno->telefono }}</p>
          <p class="card-text">Correo: {{ $alumno->correo }}</p>
          <p class="card-text">Nota media: {{ $alumno->nota_media }}</p>
        </div>
        <div class="options" style="margin-left: 16px; margin-bottom: 10px;">
          <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-outline-success">Ver</a>
          <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-outline-info">Editar</a>
          <a
            data-href="{{ route('alumnos.destroy', $alumno->id) }}"
            class="btn btn-outline-danger"
            data-bs-toggle="modal"
            data-bs-target="#deleteModal"
          >Eliminar</a>
        </div>
      </div>
    </div>
  @empty
    <p class="text-center">No hay alumnos registrados.</p>
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
  const formDelete = document.getElementById('form-delete');

  deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
      const action = this.getAttribute('data-href');
      formDelete.setAttribute('action', action);
    });
  });
});
</script>
@endsection
