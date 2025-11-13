<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AlumnoController extends Controller
{
    //Creo la base del laravel para verlo todo
    public function index(): View
    {
        $alumnos = Alumno::all();
        return view('alumnos.index', compact('alumnos'));
    }

    //Creo create
    public function create(): View
    {
        return view('alumnos.create');
    }

    //Aqui se almacenará la base de datos
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre'            => 'required|string|max:50',
            'apellidos'         => 'required|string|max:100',
            'telefono'          => 'required|string|max:20',
            'correo'            => 'required|email|max:100|unique:alumnos,correo',
            'fecha_nacimiento'  => 'required|date',
            'nota_media'        => 'required|numeric|min:0|max:10',
            'experiencia'       => 'nullable|string',
            'formacion'         => 'nullable|string',
            'habilidades'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            //Guardar los datos sin la imagen primero
            $alumno = new Alumno($validated);
            $alumno->save();

            //Si el usuario subió una imagen
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = uniqid('alumno_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/img'), $name);        
                $alumno->fotografia = 'assets/img/' . $name;         
            }


            return redirect()
                ->route('alumnos.index')
                ->with('general', 'Alumno añadido correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'general' => 'Ocurrió un error al guardar el alumno. Inténtalo de nuevo.'
            ]);
        }
    }

    //Esto mostrara la parte de menu
    public function show(Alumno $alumno): View
    {
        $year = Carbon::now()->year;
        return view('alumnos.show', compact('alumno', 'year'));
    }

    //Aqui podre editar el CV
    public function edit(Alumno $alumno): View
    {
        return view('alumnos.edit', compact('alumno'));
    }

    //Cuando edite tendre que update el archivo
    public function update(Request $request, Alumno $alumno): RedirectResponse
    {
        $validated = $request->validate([     //Se asegura que todo sta correcto
            'nombre'            => 'required|string|max:50',
            'apellidos'         => 'required|string|max:100',
            'telefono'          => 'required|string|max:20',
            'correo'            => 'required|email|max:100|unique:alumnos,correo,' . $alumno->id,
            'fecha_nacimiento'  => 'required|date',
            'nota_media'        => 'required|numeric|min:0|max:10',
            'experiencia'       => 'nullable|string',
            'formacion'         => 'nullable|string',
            'habilidades'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'delete_image'      => 'nullable|in:1',
        ]);

        try {
            //Actualizar datos del alumno
            $alumno->fill(collect($validated)->except(['image', 'delete_image'])->toArray());
            $alumno->save();

            //Si se marcó eliminar imagen
            if (($validated['delete_image'] ?? null) === '1') {
                if ($alumno->fotografia && file_exists(public_path($alumno->fotografia))) {
                    unlink(public_path($alumno->fotografia));
                }
                $alumno->fotografia = null;
                $alumno->save();
            }

            //Si se sube una nueva imagen
            if ($request->hasFile('image')) {
                // Borramos la anterior si existe
                if ($alumno->fotografia && file_exists(public_path($alumno->fotografia))) {
                    unlink(public_path($alumno->fotografia));
                }

                //Subimos la nueva
                $path = $this->upload($request, $alumno->id);
                $alumno->fotografia = $path;
                $alumno->save();
            }

            return redirect()
                ->route('alumnos.index')
                ->with('general', 'Currículum actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'general' => 'Error al actualizar el currículum: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy(Alumno $alumno): RedirectResponse
    {
        try {
            if ($alumno->fotografia && Storage::disk('private')->exists($alumno->fotografia)) {
                Storage::disk('private')->delete($alumno->fotografia);
            }
            $alumno->delete();
            return redirect()->route('alumnos.index')->with('general', 'Se ha eliminado el CV.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general' => 'El CV no ha podido borrarse.']);
        }
    }

    //Servir la imagen privada del alumno
     
    public function image(Alumno $alumno)
    {
        if (!$alumno->fotografia || !Storage::disk('private')->exists($alumno->fotografia)) {
            abort(404);
        }

        $fullPath = Storage::disk('private')->path($alumno->fotografia);
        return response()->file($fullPath);
    }


    //Sube la imagen al disco 'private' y devuelve la ruta relativa

    private function upload(Request $request, int $alumnoId): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        if (!$file->isValid()) {
            return null;
        }

        $fileName = 'alumno_' . $alumnoId . '.' . $file->getClientOriginalExtension();
        $destination = public_path('assets/img');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $fileName);

        return 'assets/img/' . $fileName;
    }
}
