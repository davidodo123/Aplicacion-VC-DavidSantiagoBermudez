<?php

namespace App\Http\Controllers;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::latest()->paginate(9);
        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:30',
            'correo' => 'required|email|unique:alumnos,correo',
            'fecha_nacimiento' => 'nullable|date',
            'nota_media' => 'nullable|numeric|min:0|max:10',
            'experiencia' => 'nullable|string',
            'formacion' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'fotografia' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('fotografia')) {
            $data['fotografia'] = $request->file('fotografia')->store('alumnos', 'public');
        }

        $alumno = Alumno::create($data);
        return redirect()->route('alumnos.show', $alumno)->with('ok','Creado');
    }

    public function show(Alumno $alumno)
    {
        return view('alumnos.show', compact('alumno'));
    }

    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:30',
            'correo' => "required|email|unique:alumnos,correo,{$alumno->id}",
            'fecha_nacimiento' => 'nullable|date',
            'nota_media' => 'nullable|numeric|min:0|max:10',
            'experiencia' => 'nullable|string',
            'formacion' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'fotografia' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('fotografia')) {
            $data['fotografia'] = $request->file('fotografia')->store('alumnos', 'public');
        }

        $alumno->update($data);
        return redirect()->route('alumnos.show', $alumno)->with('ok','Actualizado');
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return back()->with('ok','Eliminado');
    }
}
