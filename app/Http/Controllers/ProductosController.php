<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function index()
    {
        if (Auth::user()->roll != 'Administrador') {
                    return redirect('Inicio')->with('error', 'No tienes permiso para acceder a esta sección.');
                }
        $productos = Productos::with('categoria', 'usuario')->orderBy('id_p', 'desc')->get();
        return view('modulos.productos.index', compact('productos'));
    }

   /**
     * Mostrar formulario para crear un nuevo producto
     */
    public function create()
    {
        $categorias = Categorias::where('activo_c', true)->get();
        return view('modulos.productos.AgregarProducto', compact('categorias'));
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        // Normalizar inputs: soportar formularios que usen names con o sin sufijo _p
        $normalized = [];
        $normalized['nombre_p'] = $request->input('nombre_p', $request->input('nombre'));
        $normalized['descripcion_p'] = $request->input('descripcion_p', $request->input('descripcion'));
        $normalized['categoria_id'] = $request->input('categoria_id');
        $normalized['stock_p'] = $request->input('stock_p', $request->input('stock'));
        $normalized['precio_compra_p'] = $request->input('precio_compra_p', $request->input('precio_compra'));
        $normalized['precio_venta_p'] = $request->input('precio_venta_p', $request->input('precio_venta'));
        // Merge normalized values into the request so validation can use *_p names
        $request->merge($normalized);

        $request->validate([
            'nombre_p' => 'required|max:150',
            'categoria_id' => 'nullable|exists:categorias,id_c',
            'stock_p' => 'required|integer|min:0',
            'precio_compra_p' => 'required|numeric|min:0',
            'precio_venta_p' => 'required|numeric|min:0',
            // allow image file sent as 'imagen' or 'imagen_p'
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'imagen_p' => 'nullable',
            'descripcion_p' => 'nullable|string',
        ]);

        // Manejo del archivo: priorizar input 'imagen', sino 'imagen_p' (si se subió por otro nombre)
        $imagen = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->store('productos', 'public');
        } elseif ($request->hasFile('imagen_p')) {
            $imagen = $request->file('imagen_p')->store('productos', 'public');
        }

        Productos::create([
            'codigo_p' => $request->input('codigo_p'),
            'nombre_p' => $request->input('nombre_p'),
            'descripcion_p' => $request->input('descripcion_p'),
            'categoria_id' => $request->input('categoria_id'),
            'stock_p' => $request->input('stock_p'),
            'precio_compra_p' => $request->input('precio_compra_p'),
            'precio_venta_p' => $request->input('precio_venta_p'),
            'imagen_p' => $imagen,
            'usuario_id' => Auth::id(),
            'activo_p' => true,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente.');
    }

    /**
     * Mostrar formulario para editar un producto
     */
    public function edit($id)
    {
        $producto = Productos::findOrFail($id);
        $categorias = Categorias::where('activo_c', true)->get();
        return view('modulos.productos.EditarProducto', compact('producto', 'categorias'));
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, $id)
    {
        $producto = Productos::findOrFail($id);
        // Normalizar inputs para soportar names con o sin sufijo _p
        $normalized = [];
        $normalized['nombre_p'] = $request->input('nombre_p', $request->input('nombre'));
        $normalized['descripcion_p'] = $request->input('descripcion_p', $request->input('descripcion'));
        $normalized['stock_p'] = $request->input('stock_p', $request->input('stock'));
        $normalized['precio_compra_p'] = $request->input('precio_compra_p', $request->input('precio_compra'));
        $normalized['precio_venta_p'] = $request->input('precio_venta_p', $request->input('precio_venta'));
        $normalized['categoria_id'] = $request->input('categoria_id');
        $request->merge($normalized);

        $request->validate([
            'nombre_p' => 'required|max:150',
            'categoria_id' => 'nullable|exists:categorias,id_c',
            'stock_p' => 'required|integer|min:0',
            'precio_compra_p' => 'required|numeric|min:0',
            'precio_venta_p' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'imagen_p' => 'nullable',
            'descripcion_p' => 'nullable|string',
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen_p) {
                Storage::disk('public')->delete($producto->imagen_p);
            }
            $producto->imagen_p = $request->file('imagen')->store('productos', 'public');
        } elseif ($request->hasFile('imagen_p')) {
            if ($producto->imagen_p) {
                Storage::disk('public')->delete($producto->imagen_p);
            }
            $producto->imagen_p = $request->file('imagen_p')->store('productos', 'public');
        }

        $producto->update([
            'codigo_p' => $request->input('codigo_p'),
            'nombre_p' => $request->input('nombre_p'),
            'descripcion_p' => $request->input('descripcion_p'),
            'categoria_id' => $request->input('categoria_id'),
            'stock_p' => $request->input('stock_p'),
            'precio_compra_p' => $request->input('precio_compra_p'),
            'precio_venta_p' => $request->input('precio_venta_p'),
            'usuario_id' => Auth::id(),
            'imagen_p' => $producto->imagen_p,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Desactivar o activar producto
     */
    public function toggleActivo($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->activo_p = !$producto->activo_p;
        $producto->save();

        $estado = $producto->activo_p ? 'activado' : 'desactivado';
        return redirect()->route('productos.index')->with('success', "Producto {$estado} correctamente.");
    }

    /**
     * Eliminar producto (opcional)
     */
    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);

        if ($producto->imagen_p) {
            Storage::disk('public')->delete($producto->imagen_p);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}

