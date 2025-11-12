@extends('template.base')

@section('content')
<h2 class="mb-4">Editar alumno</h2>

<form action="{{ route('alumnos.update', $alumno) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre"
            value="{{ old('nombre', $alumno->nombre) }}" maxlength="50" required>
    </div>

    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos:</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos"
            value="{{ old('apellidos', $alumno->apellidos) }}" maxlength="100" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="tel" class="form-control" id="telefono" name="telefono"
            value="{{ old('telefono', $alumno->telefono) }}" maxlength="20" required>
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo electrónico:</label>
        <input type="email" class="form-control" id="correo" name="correo"
            value="{{ old('correo', $alumno->correo) }}" maxlength="100" required>
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
            value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}" required>
    </div>

    <div class="mb-3">
        <label for="nota_media" class="form-label">Nota media:</label>
        <input type="number" class="form-control" id="nota_media" name="nota_media"
            value="{{ old('nota_media', $alumno->nota_media) }}" min="0" max="10" step="0.1" required>
    </div>

    <div class="mb-3">
        <label for="experiencia" class="form-label">Experiencia:</label>
        <textarea class="form-control" id="experiencia" name="experiencia" rows="3"
            placeholder="Describe tu experiencia...">{{ old('experiencia', $alumno->experiencia) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="formacion" class="form-label">Formación:</label>
        <textarea class="form-control" id="formacion" name="formacion" rows="3"
            placeholder="Describe tu formación académica...">{{ old('formacion', $alumno->formacion) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="habilidades" class="form-label">Habilidades:</label>
        <textarea class="form-control" id="habilidades" name="habilidades" rows="3"
            placeholder="Cuéntanos tus habilidades...">{{ old('habilidades', $alumno->habilidades) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Foto actual:</label>
        <div class="mb-2">
            <img
                src="{{ $alumno->fotografia ? asset($alumno->fotografia) : asset('assets/img/sin-foto.webp') }}"
                alt="Foto actual"
                class="img-thumbnail"
                style="width:150px; height:150px; object-fit:cover;"
                onerror="this.src='{{ asset('assets/img/sin-foto.webp') }}';">
        </div>

        @if($alumno->fotografia)
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="delete_image" id="delete_image" value="1">
            <label class="form-check-label" for="delete_image">
                Eliminar imagen actual
            </label>
        </div>
        @endif

        <label class="form-label">Nueva foto:</label>
        <div id="drop-zone" class="border border-secondary rounded d-flex flex-column align-items-center justify-content-center p-4 text-center" style="cursor:pointer;background-color:#f8f9fa;">
            <p class="mb-2" id="drop-text">Arrastra tu nueva imagen aquí o haz clic para seleccionarla</p>
            <img id="preview" src="{{ asset('assets/img/sin-foto.webp') }}" alt="Vista previa" class="img-thumbnail mt-2" style="max-width:200px;height:auto;">
        </div>
        <input type="file" id="image" name="image" accept="image/*" class="d-none">
    </div>

    <button type="submit" class="btn btn-success">Actualizar alumno</button>
    <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const dropZone = document.getElementById('drop-zone');
    const inputFile = document.getElementById('image');
    const preview = document.getElementById('preview');
    const dropText = document.getElementById('drop-text');

    dropZone.addEventListener('click', () => inputFile.click());
    inputFile.addEventListener('change', (e) => handleFile(e.target.files[0]));
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-primary'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-primary'));
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-primary');
        const file = e.dataTransfer.files[0];
        inputFile.files = e.dataTransfer.files;
        handleFile(file);
    });

    function handleFile(file) {
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
            dropText.textContent = 'Nueva imagen seleccionada';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
