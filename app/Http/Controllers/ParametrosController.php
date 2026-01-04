<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametros;

class ParametrosController extends Controller
{
     public function ParametrosIndex()
    {
        $parametros = Parametros::first();
        return view('modulos.parametros.Parametros', compact('parametros'));
    }
    public function AgregarParametros()
    {
        $parametros = Parametros::first();
        return view('modulos.parametros.AgregarParametros', compact('parametros'));
    }

    public function GuardarParametros(Request $request, $id)
    {
        $parametros = Parametros::findOrFail($id);
        $parametros->nombre_Sistema = $request->input('nombre_Sistema');
        $parametros->Administrador = $request->input('Administrador');
        $parametros->save();

        return redirect()->route('Parametros.index')->with('success', 'Parámetros actualizados correctamente.');
    }

}
