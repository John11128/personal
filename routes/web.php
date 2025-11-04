<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\ReportesController;


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
 Route::get('Primer-Usuario', [UsuariosController::class, 'PrimerUsuario']);
Route::get('Usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::post('Usuarios', [UsuariosController::class, 'store']);
Route::get('Cambiar-Estado-Usuario/{estado}/{id}', [UsuariosController::class, 'CambiarEstado']);
Route::get('Editar-Usuario/{id}', [UsuariosController::class, 'edit']);
Route::post('Verificar-Usuario', [UsuariosController::class, 'VerificarUsuario']);
Route::put('Actualizar-Usuario', [UsuariosController::class, 'update']);


//Categorias
Route::middleware(['auth'])->group(function () {
Route::get('Categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('Categorias/crear', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('Categorias', [CategoriasController::class, 'store'])->name('categorias.store');
Route::get('Categorias/{id}/editar', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::put('Categorias/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
Route::resource('categorias', CategoriasController::class)->except(['show']);
Route::get('categorias/{id}/desactivar', [CategoriasController::class, 'desactivar'])->name('categorias.desactivar');
Route::get('Categorias/Desactivados', [CategoriasController::class, 'desactivados'])->name('categorias.desactivados');
});



//Productos
Route::middleware(['auth'])->group(function () {
    Route::get('/Productos', [ProductosController::class, 'index'])->name('productos.index');
    Route::get('/Productos/crear', [ProductosController::class, 'create'])->name('productos.create');
    Route::post('/Productos', [ProductosController::class, 'store'])->name('productos.store');
    Route::get('/Productos/{id}/editar', [ProductosController::class, 'edit'])->name('productos.edit');
    Route::put('/Productos/{id}', [ProductosController::class, 'update'])->name('productos.update');
    Route::put('/Productos/{id}/toggle', [ProductosController::class, 'toggleActivo'])->name('productos.toggle');
    Route::delete('/Productos/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
    Route::get('/Productos/Desactivados', [ProductosController::class, 'desactivados'])->name('productos.desactivados');
});

//Movimientos
Route::middleware(['auth'])->group(function () {
    // Definir rutas para movimientos aquí
    Route::get('/Movimientos', [MovimientosController::class, 'index'])->name('movimientos.index');
    Route::get('/Movimientos/crear', [MovimientosController::class, 'create'])->name('movimientos.create');
    Route::post('/Movimientos', [MovimientosController::class, 'store'])->name('movimientos.store');
    Route::get('/Movimientos/{id}/editar', [MovimientosController::class, 'edit'])->name('movimientos.edit');
    Route::put('/Movimientos/{id}', [MovimientosController::class, 'update'])->name('movimientos.update');
    Route::post('/Movimientos/{id}/deshacer', [MovimientosController::class, 'deshacer'])->name('movimientos.deshacer');
});

//Reportes
Route::middleware(['auth'])->group(function () {
    Route::get('/Reportes', [ReportesController::class, 'index'])->name('reportes.index');
    Route::get('/Reportes/exportar-excel', [ReportesController::class, 'exportExcel'])->name('reportes.export.excel');
    Route::get('/Reportes/exportar-pdf', [ReportesController::class, 'exportPDF'])->name('reportes.export.pdf');
    Route::post('/Reportes/importar-excel', [ReportesController::class, 'importExcel'])->name('reportes.import.excel');
});


Auth::routes();
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
