<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\tarifaController;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [employeesController::class, 'index']);
Route::get('/tarifa', [tarifaController::class, 'index']);