<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentasDirectasController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('vistaPrincipal', [RentasDirectasController::class, 'vistaPrincipal'])->name('Inicio');
Route::get('getHistorias', [RentasDirectasController::class, 'getHistorias'])->name('getHistorias');
Route::post('/collage/enviar', [RentasDirectasController::class, ''])->name('collage.enviar');

Route::get('/', [RentasDirectasController::class, 'welcome'])->name('welcome');
Route::get('rutas', [RentasDirectasController::class, 'rutas'])->name('rutas');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('vistaDashboard', [RentasDirectasController::class, 'vistaDashboard'])->name('vistaDashboard');
