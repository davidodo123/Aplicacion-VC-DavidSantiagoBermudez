<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Database\QueryException;

class AlumnoController extends Controller
{
    public function index(): View
    {
        $alumnos = Alumno::all();
        return view('alumnos.index', compact('alumnos'));
    }

    public function create(): View
    {
        return view('alumnos.create');
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'nombre'            => 'required|string|max:255',
        'apellidos'         => 'required|string|max:255',
        'correo'            => 'required|email|unique:alumnos,correo',
        'telefono'          => 'nullable|string|max:30',
        'fecha_nacimiento'  => 'nullable|date',
        'nota_media'        => 'nullable|numeric|min:0|max:10',
        'experiencia'       => 'nullable|string',
        'formacion'         => 'nullable|string',
        'habilidades'       => 'nullable|string',
        'fotografia'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    // 1) Guardar sin la foto para obtener ID
    $alumno = Alumno::create(collect($data)->except('fotografia')->toArray());

    // 2) Si viene foto, subirla al disco 'private' y guardar la ruta
    if ($request->hasFile('fotografia')) {
        $path = $this->upload($request, $alumno->id);   // "images/3.jpg"
        if ($path) {
            $alumno->update(['fotografia' => $path]);
        }
    }

    return redirect()->route('main.index')->with('general', 'Alumno creado correctamente.');
}

private function upload(Request $request, int $id): ?string
{
    if (!$request->hasFile('fotografia')) return null;
    $image = $request->file('fotografia');
    if (!$image->isValid()) return null;

    $fileName = $id . '.' . $image->getClientOriginalExtension();
    return $image->storeAs('images', $fileName, 'private'); // guarda en storage/app/private/images
}





    public function show(Alumno $alumno): View
    {
        $year = Carbon::now()->year;
        return view('alumnos.show', compact('alumno', 'year'));
    }

    public function edit(Alumno $alumno): View
    {
        return view('alumnos.edit', compact('alumno'));
    }

   public function update(Request $request, Alumno $alumno)
{
    $data = $request->validate([
        'nombre'            => 'required|string|max:255',
        'apellidos'         => 'required|string|max:255',
        'correo'            => 'required|email|unique:alumnos,correo,'.$alumno->id,
        'telefono'          => 'nullable|string|max:30',
        'fecha_nacimiento'  => 'nullable|date',
        'nota_media'        => 'nullable|numeric|min:0|max:10',
        'experiencia'       => 'nullable|string',
        'formacion'         => 'nullable|string',
        'habilidades'       => 'nullable|string',
        'fotografia'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        'remove_image'      => 'nullable|in:1',
    ]);

    // 1) Actualiza campos normales
    $alumno->update(collect($data)->except(['fotografia','remove_image'])->toArray());

    // 2) Eliminar foto si se marcó
    if ($request->boolean('remove_image') && $alumno->fotografia) {
        if (Storage::disk('private')->exists($alumno->fotografia)) {
            Storage::disk('private')->delete($alumno->fotografia);
        }
        $alumno->update(['fotografia' => null]);
    }

    // 3) Subir nueva foto (borra la anterior si existe)
    if ($request->hasFile('fotografia')) {
        if ($alumno->fotografia && Storage::disk('private')->exists($alumno->fotografia)) {
            Storage::disk('private')->delete($alumno->fotografia);
        }
        $path = $this->upload($request, $alumno->id);   // "images/3.jpg"
        if ($path) {
            $alumno->update(['fotografia' => $path]);
        }
    }

    return redirect()->route('main.index')->with('general', 'Alumno actualizado correctamente.');
}


   public function destroy(\App\Models\Alumno $alumno)
{
    try {
        if ($alumno->fotografia && \Storage::disk('private')->exists($alumno->fotografia)) {
            \Storage::disk('private')->delete($alumno->fotografia);
        }

        $alumno->delete();

        return redirect()->route('main.index')
            ->with('general', 'Alumno eliminado correctamente.');
    } catch (\Throwable $e) {
        report($e);
        return back()
            ->withInput()
            ->withErrors(['general' => 'No se pudo eliminar: '.$e->getMessage()]);
    }
}


    /**
     * Servir imagen privada del alumno
     */
public function foto(Alumno $alumno)
{
    if (!$alumno->fotografia) abort(404);
    if (!Storage::disk('private')->exists($alumno->fotografia)) abort(404);

    $path = Storage::disk('private')->path($alumno->fotografia);
    $mime = File::mimeType($path) ?? 'image/jpeg';
    return response()->file($path, ['Content-Type' => $mime]);
}


}
