@csrf
@if(isset($alumno))
    @method('PUT')
@endif

<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input name="nombre"
           value="{{ old('nombre', isset($alumno) ? $alumno->nombre : '') }}"
           class="form-control"
           required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Apellidos</label>
    <input name="apellidos"
           value="{{ old('apellidos', isset($alumno) ? $alumno->apellidos : '') }}"
           class="form-control"
           required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Correo</label>
    <input type="email"
           name="correo"
           value="{{ old('correo', isset($alumno) ? $alumno->correo : '') }}"
           class="form-control"
           required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Teléfono</label>
    <input name="telefono"
           value="{{ old('telefono', isset($alumno) ? $alumno->telefono : '') }}"
           class="form-control">
  </div>

  <div class="col-md-4">
    <label class="form-label">Fecha de nacimiento</label>
    <input type="date"
           name="fecha_nacimiento"
           value="{{ old('fecha_nacimiento', isset($alumno) ? $alumno->fecha_nacimiento : '') }}"
           class="form-control">
  </div>

  <div class="col-md-4">
    <label class="form-label">Nota media</label>
    <input type="number"
           step="0.01" min="0" max="10"
           name="nota_media"
           value="{{ old('nota_media', isset($alumno) ? $alumno->nota_media : '') }}"
           class="form-control">
  </div>

  <div class="col-md-4">
    <label class="form-label">Fotografía</label>
    <input type="file" name="fotografia" class="form-control">
    @if(isset($alumno) && $alumno->fotografia)
      <img src="{{ asset('assets/img/'.$alumno->fotografia) }}"
           alt="Foto" class="img-thumbnail mt-2" width="120">
    @endif
  </div>

  <div class="col-12">
    <label class="form-label">Formación</label>
    <textarea name="formacion" rows="3" class="form-control">{{ old('formacion', isset($alumno) ? $alumno->formacion : '') }}</textarea>
  </div>

  <div class="col-12">
    <label class="form-label">Experiencia</label>
    <textarea name="experiencia" rows="3" class="form-control">{{ old('experiencia', isset($alumno) ? $alumno->experiencia : '') }}</textarea>
  </div>

  <div class="col-12">
    <label class="form-label">Habilidades</label>
    <textarea name="habilidades" rows="2" class="form-control">{{ old('habilidades', isset($alumno) ? $alumno->habilidades : '') }}</textarea>
  </div>

  <div class="col-12 mt-2">
    <button class="btn btn-primary">Guardar</button>
    <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
  </div>
</div>
