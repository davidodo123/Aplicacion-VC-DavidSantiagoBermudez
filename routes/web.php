<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', [MainController::class, 'index'])->name('main.index');

// CRUD de alumnos (CVs)
Route::resource('alumnos', AlumnoController::class);

// Ruta para mostrar fotos privadas desde storage
Route::get('alumnos/{alumno}/foto', [AlumnoController::class, 'image'])
    ->name('alumnos.foto');