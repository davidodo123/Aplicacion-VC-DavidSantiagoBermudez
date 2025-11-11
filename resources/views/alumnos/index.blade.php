@extends('template.base')

@section('content')
  {{-- Modal de confirmación --}}
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Borrando alumno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Vas a eliminar este alumno, ¿seguro?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cerrar</button>
        <button form="form-delete" type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div></div>
  </div>

  <table class="table table-hover align-middle">
    <thead>
      <tr class="text-center">
        <th>#</th>
        <th>Foto</th>
        <th>Nombre completo</th>
        <th>Nota media</th>
        <th>Acción</th>
      </tr>
    </thead>

    <tbody>
      @forelse($alumnos as $alumno)
        <tr class="text-center">
          <td>{{ $alumno->id }}</td>

          <td>
            <img
              src="{{ $alumno->fotografia ? route('alumnos.foto', $alumno) : asset('assets/img/sin-foto.webp') }}"
              alt="Foto de {{ $alumno->nombre }}"
              style="width:50px;height:50px;border-radius:10px;object-fit:cover;">
          </td>

          <td>{{ $alumno->nombre }} {{ $alumno->apellidos }}<br>
              <small class="text-muted">{{ $alumno->correo }} · {{ $alumno->telefono }}</small>
          </td>

          <td>{{ $alumno->nota_media }}</td>

          <td>
            <a href="{{ route('alumnos.show', $alumno) }}" class="btn btn-outline-success btn-sm">Ver</a>
            <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-outline-info btn-sm">Editar</a>
            <a  data-href="{{ route('alumnos.destroy', $alumno) }}"
                class="btn btn-outline-danger btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal">
              Eliminar
            </a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center text-muted">No hay alumnos registrados.</td>
        </tr>
      @endforelse
    </tbody>

    <tfoot>
      <tr>
        <th colspan="3">Total de alumnos:</th>
        <th class="text-end">{{ count($alumnos) }}</th>
        <th></th>
      </tr>
    </tfoot>
  </table>

  {{-- Formulario invisible para enviar el DELETE --}}
  <form id="form-delete" action="" method="post">
    @csrf
    @method('DELETE')
  </form>
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const formDelete = document.getElementById('form-delete');
      document.querySelectorAll('[data-bs-target="#deleteModal"]').forEach(btn => {
        btn.addEventListener('click', function () {
          formDelete.action = this.getAttribute('data-href');
        });
      });
    });
  </script>
@endsection
