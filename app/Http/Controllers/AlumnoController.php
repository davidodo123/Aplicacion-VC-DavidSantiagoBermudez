<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|unique:alumnos,correo',
            'telefono' => 'nullable|string|max:30',
            'fecha_nacimiento' => 'nullable|date',
            'nota_media' => 'nullable|numeric',
            'experiencia' => 'nullable|string',
            'formacion' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('fotografia')) {
            $file = $request->file('fotografia');
            $name = Str::uuid()->toString().'.'.$file->extension();

            $dir = public_path('assets/img');            
            if (!is_dir($dir)) { mkdir($dir, 0775, true); }

            $file->move($dir, $name);                   
            $data['fotografia'] = $name;                 
        }

        $alumno = Alumno::create($data);
        return redirect()->route('alumnos.show', $alumno)->with('ok', 'Creado');
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
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => "required|email|unique:alumnos,correo,{$alumno->id}",
            'telefono' => 'nullable|string|max:30',
            'fecha_nacimiento' => 'nullable|date',
            'nota_media' => 'nullable|numeric',
            'experiencia' => 'nullable|string',
            'formacion' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

       if ($request->hasFile('fotografia')) {
        if (($alumno->fotografia ?? null) && Storage::disk('public')->exists($alumno->fotografia)) {
            Storage::disk('public')->delete($alumno->fotografia);
        }

        $data['fotografia'] = $request->file('fotografia')->store('alumnos', 'public');
    }
        $alumno->update($data);
        return redirect()->route('alumnos.show', $alumno)->with('ok', 'Actualizado');
    }

    public function destroy(Alumno $alumno)
    {
        if ($alumno->fotografia) {
            $path = public_path('assets/img/'.$alumno->fotografia);
            if (is_file($path)) @unlink($path);
        }

        $alumno->delete();
        return redirect()->route('alumnos.index')->with('ok', 'CV eliminado correctamente.');
    }
}
