<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\ObservacionController;
use App\Http\Controllers\PlanRController;
use App\Http\Controllers\PlanWController;
use App\Http\Controllers\OntController;
use App\Http\Controllers\UraController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PuertoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

// Rutas Públicas - Autenticación
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas Protegidas del Sistema
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('layouts.app');
    })->name('dashboard');

    Route::resource('clientes', ClienteController::class);
    Route::resource('reservas', ReservaController::class);
    Route::resource('lineas', LineaController::class);
    
    Route::resource('observaciones', ObservacionController::class)
        ->parameters(['observaciones' => 'observacion']);
        
    Route::resource('planes_w', PlanWController::class)
        ->parameters(['planes_w' => 'planW']);
        
    Route::resource('planes_r', PlanRController::class)
        ->parameters(['planes_r' => 'planR']);
        
    Route::resource('onts', OntController::class);
    Route::resource('uras', UraController::class);
    Route::resource('equipos', EquipoController::class);
    Route::resource('puertos', PuertoController::class);
    Route::resource('servicios', ServicioController::class);
    Route::resource('users', UserController::class);

});