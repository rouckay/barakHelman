<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\numerahaController;
use App\Http\Controllers\SharwaliTarifa;

// Route::get('/', function () {
//     return view('home');
// });
// Route::redirect('/', '/admin/login');
// Route::get('/', [numerahaController::class, 'index']);
Route::get('/download-invoice/{id}', [SharwaliTarifa::class, 'downloadInvoice'])->name('download.invoice');
