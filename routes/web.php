<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProfileController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('modulos.users.Ingresar');
});


Route::get('Inicio', function () {
    return view('modulos.Inicio');
});

//Mis Datos
Route::get('/perfil', [ProfileController::class, 'verperfil'])->name('profile.edit');
Route::post('/perfil', [ProfileController::class, 'ActualizarMisDatos'])->name('profile.update');

//Usuarios
// Route::get('Primer-Usuario', [UsuariosController::class, 'PrimerUsuario']);
Route::get('Usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::post('Usuarios', [UsuariosController::class, 'store']);
Route::get('Cambiar-Estado-Usuario/{estado}/{id}', [UsuariosController::class, 'CambiarEstado']);
Route::get('Editar-Usuario/{id}', [UsuariosController::class, 'edit']);
Route::post('Verificar-Usuario', [UsuariosController::class, 'VerificarUsuario']);
Route::put('Actualizar-Usuario', [UsuariosController::class, 'update']);


Auth::routes();
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
