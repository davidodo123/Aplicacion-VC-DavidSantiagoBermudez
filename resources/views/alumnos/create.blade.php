@extends('template.base')

@section('content')
<form action="{{ route('alumnos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Añade tu nombre..." maxlength="20" value="{{ old('nombre') }}" required>
    </div>

    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos:</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Añade tus apellidos..." maxlength="60" value="{{ old('apellidos') }}" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Añade tu número de teléfono..." maxlength="20" value="{{ old('telefono') }}" required>
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo electrónico:</label>
        <input type="email" class="form-control" id="correo" name="correo" placeholder="Añade tu correo..." value="{{ old('correo') }}" required>
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
    </div>

    <div class="mb-3">
        <label for="nota_media" class="form-label">Nota media:</label>
        <input type="number" class="form-control" id="nota_media" name="nota_media" placeholder="Añade tu nota media..." min="0" max="10" step="0.1" value="{{ old('nota_media') }}" required>
    </div>

    <div class="mb-3">
        <label for="experiencia" class="form-label">Experiencia:</label>
        <textarea class="form-control" id="experiencia" name="experiencia" placeholder="Describe tu experiencia...">{{ old('experiencia') }}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="formacion" class="form-label">Formación:</label>
        <textarea class="form-control" id="formacion" name="formacion" placeholder="Describe tu formación académica...">{{ old('formacion') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="habilidades" class="form-label">Habilidades:</label>
        <textarea class="form-control" id="habilidades" name="habilidades" placeholder="Cuéntanos tus habilidades...">{{ old('habilidades') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Foto:</label>
        <div id="drop-zone" class="border border-secondary rounded d-flex flex-column align-items-center justify-content-center p-4 text-center" style="cursor:pointer;background-color:#f8f9fa;">
            <p class="mb-2" id="drop-text">Arrastra tu imagen aquí o haz clic para seleccionarla</p>
            <img id="preview" src="{{ asset('assets/img/sin-foto.webp') }}" alt="Vista previa" class="img-thumbnail mt-2" style="max-width:200px;height:auto;">
        </div>
        <input type="file" id="image" name="image" accept="image/*" class="d-none">
    </div>

    <button type="submit" class="btn btn-primary">Añadir alumno</button>
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
        reader.onload = (e) => { preview.src = e.target.result; dropText.textContent = 'Imagen seleccionada'; };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
