@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input name="nombre" value="{{ old('nombre',$alumno->nombre ?? '') }}" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Apellidos</label>
    <input name="apellidos" value="{{ old('apellidos',$alumno->apellidos ?? '') }}" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Correo</label>
    <input type="email" name="correo" value="{{ old('correo',$alumno->correo ?? '') }}" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Teléfono</label>
    <input name="telefono" value="{{ old('telefono',$alumno->telefono ?? '') }}" class="form-control">
  </div>
  <div class="col-md-4">
    <label class="form-label">Fecha nacimiento</label>
    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento',$alumno->fecha_nacimiento ?? '') }}" class="form-control">
  </div>
  <div class="col-md-4">
    <label class="form-label">Nota media</label>
    <input type="number" step="0.01" min="0" max="10" name="nota_media" value="{{ old('nota_media',$alumno->nota_media ?? '') }}" class="form-control">
  </div>
  <div class="col-md-4">
    <label class="form-label">Fotografía</label>
    <input type="file" name="fotografia" class="form-control">
  </div>
  <div class="col-12">
    <label class="form-label">Formación</label>
    <textarea name="formacion" rows="3" class="form-control">{{ old('formacion',$alumno->formacion ?? '') }}</textarea>
  </div>
  <div class="col-12">
    <label class="form-label">Experiencia</label>
    <textarea name="experiencia" rows="3" class="form-control">{{ old('experiencia',$alumno->experiencia ?? '') }}</textarea>
  </div>
  <div class="col-12">
    <label class="form-label">Habilidades</label>
    <textarea name="habilidades" rows="2" class="form-control">{{ old('habilidades',$alumno->habilidades ?? '') }}</textarea>
  </div>
  <div class="col-12">
    <button class="btn btn-primary">Guardar</button>
    <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
  </div>
</div>
