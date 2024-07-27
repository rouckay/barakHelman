<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeesController;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [employeesController::class, 'index']);