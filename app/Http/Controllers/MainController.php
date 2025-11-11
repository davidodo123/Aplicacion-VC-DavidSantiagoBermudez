<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $alumnos = Alumno::all();
        return view('main.index', compact('alumnos'));
    }
}
