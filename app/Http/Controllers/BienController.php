<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use function Laravel\Prompts\error;

class BienController extends Controller
{
    public function index()
    {
        $bienes = Bien::all();
        return view('bienes.index', compact('bienes'));
    }

    public function create()
    {
        return view('bienes.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'cantidad' => 'required|integer',
        'ubicacion' => 'required|string|max:255',
        'imagen' => 'required|string', // Base64 string de la imagen recortada
    ]);

    // Guardar el bien primero para obtener el ID
    $bien = Bien::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'cantidad' => $request->cantidad,
        'ubicacion' => $request->ubicacion,
        'imagen' => null, // Se actualizará luego
    ]);

    // Decodificar la imagen Base64
    $image = $request->imagen;
    $image = str_replace('data:image/jpeg;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageData = base64_decode($image);

    // Crear el nombre basado en el ID
    $imageName = 'bienes/' . $bien->id . '.jpg';

    // Guardar la imagen en el almacenamiento
    Storage::disk('public')->put($imageName, $imageData);

    // Actualizar el bien con la ruta de la imagen
    $bien->update(['imagen' => $imageName]);

    return redirect()->route('bienes.index')->with('success', 'Bien creado con éxito.');
}

    public function edit($id)
{
    $bien = Bien::findOrFail($id);
    return view('bienes.edit', compact('bien'));
}






/* public function update(Request $request, $id)
{
    $bien = Bien::where('id', $id)->firstOrFail(); // Buscar el bien manualmente

    dd($bien); // Verifica si devuelve los datos correctamente
}
 */


public function update(Request $request, $id)
{
     $bien = Bien::findOrFail($id);
    // Validación
    Log::info('Iniciando validación de datos');
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'cantidad' => 'required|integer',
        'ubicacion' => 'required|string|max:255',
        'imagen_base64' => 'nullable|string',
    ]);
    Log::info('Validación completada Estas son la Variables ID='.$id.$request->nombre.$request->descripcion. $request->cantidad.$request->ubicacion);

    // Actualizar los datos básicos
    Log::info('Iniciando actualización de datos básicos');
    $bien->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'cantidad' => $request->cantidad,
        'ubicacion' => $request->ubicacion,
    ]);
    Log::info('Datos básicos actualizados');

    // Procesar la imagen solo si se subió una nueva
    if ($request->filled('imagen_base64')) {
        Log::info('Procesando imagen Base64');
        // Decodificar la imagen Base64
        $image = str_replace('data:image/jpeg;base64,', '', $request->imagen_base64);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        // Nombre del archivo basado en el ID del bien
        $imageName = 'bienes/' . $bien->id . '.jpg';

        // Guardar la imagen en el almacenamiento público
        Storage::disk('public')->put($imageName, $imageData);

        // Guardar la ruta en la base de datos
        $bien->update(['imagen' => $imageName]);

        Log::info('Imagen procesada y guardada');
    }

    session()->flash('success', 'Bien actualizado con éxito.');
    Log::info('Actualización completada y redirigiendo');

    return redirect()->route('bienes.index')->with('success', 'Bien actualizado con éxito.');
} 




public function destroy($id)
{
    $bien = Bien::findOrFail($id);
    $bien->delete();

    return redirect()->route('bienes.index')->with('success', 'Bien eliminado correctamente');
}

public function movimiento($id)
{
    $bien = Bien::findOrFail($id);
    return view('bienes.movimiento', compact('bien'));
}


}
