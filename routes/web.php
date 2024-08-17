<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\numerahaController;
use App\Http\Controllers\tarifaController;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [numerahaController::class, 'index']);
Route::get('/tarifa', [tarifaController::class, 'index']);
Route::get('/download-invoice/{id}', [TarifaController::class, 'downloadInvoice'])->name('download.invoice');
