<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bien;
use App\Models\Movimiento;

class MovimientoController extends Controller
{

    
    public function index($bien_id)
    {
        $bien = Bien::find($bien_id); // Asegúrate de que esta consulta es correcta
    
        if (!$bien) {
            return redirect()->route('alguna.ruta')->with('error', 'El bien no existe.');
        }
    
        $movimientos = Movimiento::where('bien_id', $bien_id)->get(); 
    
        return view('movimientos.index', compact('bien', 'movimientos'));
    }
    
    



    public function store(Request $request, $bienId)
    {
        $request->validate([
            'tipo' => 'required|in:Entrada,Salida,Préstamo,Devolución',
            'cantidad' => 'required|integer|min:1',
            'persona' => 'required|string', // La persona siempre es obligatoria
            'observaciones'=>'nullable|string'
        ]);
    
        $bien = Bien::findOrFail($bienId);
        $cantidad = $bien->cantidad;
        $prestados = $bien->prestados; // Obtener la cantidad prestada actual
    
        switch ($request->tipo) {
            case 'Entrada':
                $cantidad += $request->cantidad;
                break;
    
            case 'Salida':
                if ($bien->cantidad < $request->cantidad) {
                    return back()->with('error', 'No puedes realizar esta operación, cantidad insuficiente.');
                }
                $cantidad -= $request->cantidad;
                break;
    
            case 'Préstamo':
                if ($bien->cantidad < $request->cantidad) {
                    return back()->with('error', 'No puedes prestar más de la cantidad disponible.');
                }
                $cantidad -= $request->cantidad;
                $prestados += $request->cantidad; // Aumentar prestados
                break;
    
            case 'Devolución':
                if ($prestados < $request->cantidad) {
                    return back()->with('error', 'No puedes devolver más de lo que se ha prestado.');
                }
                $cantidad += $request->cantidad;
                $prestados -= $request->cantidad; // Reducir prestados
                break;
        }
    
        // Guardar el movimiento
        Movimiento::create([
            'bien_id' => $bienId,
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'persona' => $request->persona,
            'observaciones' => $request->observaciones

        ]);
    
        // Actualizar la cantidad y los prestados en la tabla bienes
        $bien->update([
            'cantidad' => $cantidad,
            'prestados' => $prestados
        ]);
    
        return back()->with('success', 'Movimiento registrado correctamente.');
    }
    

    
}
