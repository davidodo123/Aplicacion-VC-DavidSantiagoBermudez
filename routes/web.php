<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AlumnoController;

Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::resource('alumnos', \App\Http\Controllers\AlumnoController::class);
Route::get('/alumnos/{alumno}/foto', [\App\Http\Controllers\AlumnoController::class, 'foto'])->name('alumnos.foto');
