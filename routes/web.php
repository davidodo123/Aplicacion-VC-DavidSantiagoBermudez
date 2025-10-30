<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

Route::get('/', fn() => redirect()->route('alumnos.index'));
Route::resource('alumnos', AlumnoController::class);
