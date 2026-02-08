<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentasDirectasController;
use App\Http\Controllers\CasasController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('vistaPrincipal', [RentasDirectasController::class, 'vistaPrincipal'])->name('Inicio');

Route::get('/', [RentasDirectasController::class, 'welcome'])->name('welcome');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('vistaDashboard', [RentasDirectasController::class, 'vistaDashboard'])->name('vistaDashboard');



// routes/web.php
Route::prefix('casas')->group(function() {
    Route::get('/buscarCasas', [CasasController::class, 'buscarCasas'])->name('buscarCasas');
    Route::post('/nuevaCasa', [CasasController::class, 'nuevaCasa'])->name('nuevaCasa');
    Route::post('/mostrarCasa', [CasasController::class, 'mostrarCasa'])->name('mostrarCasa');
    Route::post('/actualizarCasa', [CasasController::class, 'actualizarCasa'])->name('actualizarCasa');

    Route::post('/obtenerImagenes', [CasasController::class, 'obtenerImagenes'])->name('obtenerImagenes');
    Route::post('/subirImagenes', [CasasController::class, 'subirImagenes'])->name('subirImagenes');
    Route::post('/eliminarImagen', [CasasController::class, 'eliminarImagen'])->name('eliminarImagen');
});