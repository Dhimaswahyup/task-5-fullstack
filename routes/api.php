<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportController;

Route::post('/login', [PassportController::class, 'login']);
Route::post('/register', [PassportController::class, 'register']);
Route::middleware('auth:api')->get('/all', [PassportController::class, 'users']);
