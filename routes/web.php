<?php

use App\Http\Controllers\PrevisaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('previsao/atual', [PrevisaoController::class, 'index'])->name("previsao.atual");
Route::post('previsao/nova', [PrevisaoController::class, 'nova'])->name("previsao.nova");