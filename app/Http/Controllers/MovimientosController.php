<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\movimientos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Productos;
use App\Models\Reportes;

class MovimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Productos::all();
        $usuarios = Auth::user();
        $movimientos = movimientos::orderBy('fecha_m', 'desc')->with('producto', 'usuario')->latest()->paginate(50);
        return view('modulos.movimientos.index', compact('movimientos', 'productos', 'usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Productos::all();
        return view('modulos.movimientos.AgregarMovimiento', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'fecha_m' => 'required|date',
        'tipo_m' => 'required|in:Entrada,Salida',
        'producto_id' => 'required|exists:productos,id_p',
        'cantidad_m' => 'required|integer|min:1',
    ]);

    $producto = Productos::findOrFail($request->producto_id);
    $cantidad = (int) $request->cantidad_m;

    if ($request->tipo_m === 'Entrada') {
        $producto->stock_p += $cantidad;
    } elseif ($request->tipo_m === 'Salida') {
        if ($producto->stock_p < $cantidad) {
            return back()->withErrors(['cantidad_m' => 'No hay suficiente stock para realizar la salida.']);
        }
        $producto->stock_p -= $cantidad;
    }

    // ✅ AQUÍ ESTÁ EL CAMBIO IMPORTANTE:
    $producto->save();

    movimientos::create([
        'fecha_m' => $request->input('fecha_m'),
        'tipo_m' => $request->input('tipo_m'),
        'producto_id' => $request->input('producto_id'),
        'cantidad_m' => $request->input('cantidad_m'),
        'usuario_id' => Auth::user()->id,
    ]);
    Reportes::create([
    'tipo_r' => 'movimiento',
    'titulo_r' => "Movimiento de tipo {$request->tipo_m}",
    'descripcion_r' => "Se registró un movimiento de {$request->tipo_m} para el producto ID {$request->producto_id}.",
    'detalle_r' => [
        'producto_id' => $request->producto_id,
        'cantidad' => $request->cantidad_m,
        'tipo' => $request->tipo_m,
        'usuario' => Auth::user()->name ?? 'Desconocido',
    ],
    'usuario_id' => Auth::id(),
]);


    return redirect()->route('movimientos.index')->with('success', 'Movimiento creado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movimiento = movimientos::findOrFail($id);
        $productos = Productos::all();
        return view('modulos.movimientos.EditarMovimiento', compact('movimiento', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'fecha_m' => 'required|date',
            'tipo_m' => 'required|in:Entrada,Salida',
            'producto_id' => 'required|exists:productos,id_p',
            'cantidad_m' => 'required|integer|min:1',
        ]);

        $movimiento = movimientos::findOrFail($id);
        $producto = Productos::findOrFail($movimiento->producto_id);

        // Revertir el efecto del movimiento original
        if ($movimiento->tipo_m === 'Entrada') {
            $producto->stock_p -= $movimiento->cantidad_m;
        } elseif ($movimiento->tipo_m === 'Salida') {
            $producto->stock_p += $movimiento->cantidad_m;
        }

        // Aplicar el nuevo movimiento
        $nuevaCantidad = (int) $request->cantidad_m;
        if ($request->tipo_m === 'Entrada') {
            $producto->stock_p += $nuevaCantidad;
        } elseif ($request->tipo_m === 'Salida') {
            if ($producto->stock_p < $nuevaCantidad) {
                return back()->withErrors(['cantidad_m' => 'No hay suficiente stock para realizar la salida.']);
            }
            $producto->stock_p -= $nuevaCantidad;
        }

        // Guardar los cambios en el producto
        $producto->save();

        // Actualizar el movimiento
        $movimiento->update([
            'fecha_m' => $request->input('fecha_m'),
            'tipo_m' => $request->input('tipo_m'),
            'producto_id' => $request->input('producto_id'),
            'cantidad_m' => $request->input('cantidad_m'),
        ]);

        return redirect()->route('movimientos.index')->with('success', 'Movimiento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deshacer($id)
{
    $mov = movimientos::findOrFail($id);
    $producto = Productos::findOrFail($mov->producto_id);
    $cantidad = $mov->cantidad_m;

    // Aplicar efecto inverso al stock correctamente
    if ($mov->tipo_m === 'entrada') {
        // Si el movimiento original fue entrada → debemos restar stock
        if ($producto->stock_p < $cantidad) {
            return back()->withErrors(['error' => 'No se puede deshacer: stock insuficiente.']);
        }
        $producto->stock_p -= $cantidad;
    } else {
        // Si el movimiento original fue salida → debemos sumar stock
        $producto->stock_p += $cantidad;
    }

    // Guardar cambio en el producto
    $producto->save();

    // Registrar el movimiento inverso (opcional, pero recomendado)
    movimientos::create([
        'fecha_m' => now(),
        'tipo_m' => $mov->tipo_m === 'entrada' ? 'salida' : 'entrada',
        'producto_id' => $producto->id_p,
        'cantidad_m' => $cantidad,
        'usuario_id' => Auth::id(),
    ]);

    return back()->with('success', 'Movimiento deshecho correctamente.');
}



}