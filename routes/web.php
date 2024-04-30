<?php

use App\Http\Controllers\PrevisaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('previsao/atual', [PrevisaoController::class, 'index'])->name("previsao.atual");
Route::post('previsao/nova', [PrevisaoController::class, 'nova'])->name("previsao.nova");
Route::get('previsao/listar', [PrevisaoController::class, 'previsoesSalvas'])->name('previsao.listar');
Route::get('previsao/ver/{id}', [PrevisaoController::class, 'previsaoSalva'])->name('previsao.salva');
Route::get('previsao/compare', [PrevisaoController::class, 'compararPrevisoes'])->name("previsao.compare");