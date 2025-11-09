Proyecto Laravel - Gestión de CVs de Alumnos

Este proyecto es una aplicación desarrollada en Laravel 12 que permite gestionar los currículums (CVs) de alumnos.
Incluye un sistema CRUD completo (crear, leer, actualizar y eliminar), conexión a MySQL, carga y visualización de fotografías, y un diseño CSS personalizado con fondo blanco y barra de navegación gris.

------------------------------------------------------------
## DESCRIPCIÓN GENERAL

La aplicación almacena información de alumnos, incluyendo sus datos personales, formación, experiencia, habilidades y una fotografía de perfil.
El proyecto está alojado en /var/www/html/laravel/VC sobre un servidor Ubuntu con Apache y MySQL.
La interfaz utiliza Blade como motor de plantillas y un CSS propio para mantener un diseño sencillo y limpio.

------------------------------------------------------------

## INSTALACIÓN Y CONFIGURACIÓN

Instalar dependencias
composer install

Crear el archivo de entorno
cp .env.example .env

Configurar conexión a base de datos
Editar el archivo .env con los siguientes valores:

APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel

Generar la clave de aplicación
php artisan key:generate

------------------------------------------------------------
## MIGRACIONES Y MODELO

Ejecutar migraciones
php artisan migrate

Añadir columna de fotografía
php artisan make:migration add_fotografia_to_alumnos_table --table=alumnos

En el método up() del archivo de migración:
$table->string('fotografia')->nullable();

Aplicar la migración:
php artisan migrate

------------------------------------------------------------
## CONTROLADOR

Archivo: app/Http/Controllers/AlumnoController.php

El controlador gestiona todas las operaciones CRUD y la subida de imágenes.
El almacenamiento de imágenes se realiza en public/assets/img.

Ejemplo de manejo de la fotografía:

if ($request->hasFile('fotografia')) {
    $file = $request->file('fotografia');
    $name = uniqid('alumno_') . '.' . $file->getClientOriginalExtension();

    $dir = public_path('assets/img');
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    $file->move($dir, $name);
    $data['fotografia'] = $name;
}

En la eliminación (destroy), el archivo también se borra del sistema si existe.

------------------------------------------------------------
## RUTAS

Archivo: routes/web.php

use App\Http\Controllers\AlumnoController;

Route::get('/', function () {
    return redirect()->route('alumnos.index');
});

Route::resource('alumnos', AlumnoController::class);

La ruta raíz (/) redirige automáticamente al listado de alumnos (/alumnos).

------------------------------------------------------------
## VISTAS Y FORMULARIOS

Estructura de vistas

- resources/views/alumnos/index.blade.php – Listado general
- resources/views/alumnos/create.blade.php – Formulario de creación
- resources/views/alumnos/edit.blade.php – Formulario de edición
- resources/views/alumnos/show.blade.php – Visualización individual
- resources/views/alumnos/form.blade.php – Fragmento común reutilizado

Formulario unificado (form.blade.php)
Contiene todos los campos requeridos y opcionales, incluyendo la carga de fotografías.

<div class="col-md-4">
  <label class="form-label">Fotografía</label>
  <input type="file" name="fotografia" class="form-control">
  @if(isset($alumno) && $alumno->fotografia)
    <img src="{{ asset('assets/img/'.$alumno->fotografia) }}" class="img-thumbnail mt-2" width="120">
  @endif
</div>

------------------------------------------------------------
## ESTILOS Y DISEÑO

Archivo principal: public/assets/css/styles.css

El diseño es minimalista, con:
- Fondo blanco
- Navbar gris claro
- Formularios limpios con bordes suaves
- Botones simples (azul principal, gris secundario)

Ejemplo de enlace en layouts/app.blade.php:

@php
  $cssPath = public_path('assets/css/styles.css');
  $v = file_exists($cssPath) ? filemtime($cssPath) : time();
@endphp

<link rel="stylesheet"
      href="{{ request()->getSchemeAndHttpHost() }}/laravel/VC/public/assets/css/styles.css?v={{ $v }}">

------------------------------------------------------------
## PERMISOS DE ARCHIVOS

Es necesario otorgar permisos de lectura y escritura en las carpetas públicas para permitir la subida de imágenes:

cd /var/www/html/laravel/VC
sudo mkdir -p public/assets/img
sudo chown -R $USER:www-data public/assets
sudo find public/assets -type d -exec chmod 775 {} \;
sudo find public/assets -type f -exec chmod 664 {} \;

------------------------------------------------------------
## RESOLUCIÓN DE PROBLEMAS

El CSS no se actualiza:
- Verificar que el archivo se cargue correctamente desde la URL pública.
- Realizar una recarga forzada del navegador (Ctrl + F5).
- Confirmar que el enlace al CSS está al final del head.
- Ejecutar php artisan config:clear si se modificó el archivo .env.
- Verificar permisos de lectura en public/assets/css.

Error de permisos al subir imágenes:
Revisar permisos en public/assets/img (ver punto 9).

Error al acceder a la raíz del sitio:
Asegurarse de tener la redirección configurada en routes/web.php