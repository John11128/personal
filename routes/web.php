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

Route::get('/perfil', function () {
    return view('modulos.users.profile.perfil');
})->name('profile.show');

// web.php
Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');



// Route::get('Primer-Usuario', [UsuariosController::class, 'PrimerUsuario']);

Auth::routes();
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
