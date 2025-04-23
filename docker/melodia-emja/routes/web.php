<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\MusicoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['auth'])->group(function () {
    Route::get('/', [EventoController::class, 'index'])->name('eventos.index');
});


Route::get('/mapa', function () {
    return view('mapa.mapa');
})->name('mapa');
Route::get('/locales', function () {
    return view('mapa.locales');
});
Route::get('/eventos', [EventoController::class, 'index'])->name('home');
Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
Route::get('/eventos/{id}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
Route::put('/eventos/{id}', [EventoController::class, 'update'])->name('eventos.update');
Route::delete('/eventos/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');
// Esta es para JSONs 

// Esta es para la vista con Vue
Route::get('/eventos/{id}', [EventoController::class, 'evento_individual'])->name('eventos.show');



Route::get('/seleccion-rol', [RegisterController::class, 'seleccionRol'])->name('seleccion.rol');
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/mensajes', [MensajeController::class, 'index'])->name('mensajes.index');
Route::post('/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {
//         return view('layouts.layout');
//     })->name('home');
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');


    Route::get('/contrato/crear', [RestauranteController::class, 'mostrarFormularioContrato'])->name('contrato.formulario');
    Route::post('/contrato/crear', [RestauranteController::class, 'crearContrato'])->name('contrato.crear');
    Route::post('/contrato/cancelar/{idContrato}', [RestauranteController::class, 'cancelarContrato'])->name('contrato.cancelar');

    Route::get('/musico/{idMusico}/ver-contrato', [MusicoController::class, 'verContrato'])->name('musico.verContrato');

    Route::get('/contrato', function () {
        return view('contrato'); // Asegúrate de crear este archivo en views
    })->name('contrato');


// });

