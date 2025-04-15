<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentasDirectasController;

Route::get('vistaPrincipal', [RentasDirectasController::class, 'vistaPrincipal'])->name('Inicio');
Route::get('getHistorias', [RentasDirectasController::class, 'getHistorias'])->name('getHistorias');
Route::post('/collage/enviar', [RentasDirectasController::class, 'enviarCorreo'])->name('collage.enviar');

Route::get('/', [RentasDirectasController::class, 'welcome'])->name('welcome');
Route::get('rutas', [RentasDirectasController::class, 'rutas'])->name('rutas');
