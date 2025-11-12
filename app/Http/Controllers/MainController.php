<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        // Obtener todos los alumnos (CVs)
        $alumnos = Alumno::all();

        // Pasar los datos a la vista principal
        return view('main.index', compact('alumnos'));
    }
}
