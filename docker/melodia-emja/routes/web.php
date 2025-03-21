<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MensajeController;
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

Route::get('/', function () {
    return view('landing');
});

Route::get('/mapa', function () {
    return view('mapa.mapa');
});

Route::resource('eventos', EventoController::class);

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/eventos/index', [EventoController::class, 'index'])->name('eventos.index');

Route::get('/mensajes', [MensajeController::class, 'index'])->name('mensajes.index');
Route::post('/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('layouts.layout');
    })->name('home');
});
