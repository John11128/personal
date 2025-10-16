<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
public function verperfil()
{
    $user = Auth::user();
    return view('modulos.users.profile.perfil', compact('user'));
// 
}

 public function ActualizarMisDatos(Request $request)
    {
        $user = Auth::user();

            $datos = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email,' . $user->id],
                'password' => ['nullable', 'string', 'min:3', 'confirmed'],
                'foto' => ['nullable', 'image', 'max:2048'],
            ]);

            // Manejo de la imagen de perfil
            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    $path = storage_path('app/public/' . $user->foto);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $rutaImg = $request->file('foto')->store('users', 'public');
            } else {
                $rutaImg = $user->foto;
            }

            // Datos a actualizar
            $updateData = [
                'name' => $datos['name'],
                'email' => $datos['email'],
                'foto' => $rutaImg,
            ];

            if (!empty($datos['password'])) {
                $updateData['password'] = Hash::make($datos['password']);
            }

            // Actualiza el usuario
            DB::table('users')->where('id', $user->id)->update($updateData);
        $user->refresh();
            return redirect('/perfil')->with('success', 'Datos actualizados correctamente');
        }


}