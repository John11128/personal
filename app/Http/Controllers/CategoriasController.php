<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::orderBy('id_c', 'desc')->where('activo_c', 1)->paginate(50);
        return view('modulos.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('modulos.categorias.AgregarCategoria');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Categorias::create([
            'nombre_c' => $request->input('nombre'),
            'descripcion_c' => $request->input('descripcion'),
            'activo_c' => 1,
            'usuario_id' => Auth::id(),
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit($id)
    {
        $categoria = Categorias::findOrFail($id);
        return view('modulos.categorias.EditarCategoria', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $categoria = Categorias::findOrFail($id);
        $categoria->update([
            'nombre_c' => $request->input('nombre'),
            'descripcion_c' => $request->input('descripcion'),
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function desactivar($id)
    {
        $categoria = Categorias::findOrFail($id);
        // Toggle the activo_c flag
        $categoria->activo_c = !$categoria->activo_c;
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Estado de la categoría actualizado.');
    }

    public function desactivados()
    {
        $categorias = Categorias::orderBy('id_c', 'desc')->where('activo_c', 0)->paginate(50);
        return view('modulos.categorias.desactivados', compact('categorias'));
    }

    public function destroy($id)
    {
        Categorias::findOrFail($id)->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada permanentemente.');
    }
}
