<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ArticlesController;

Auth::routes();

Route::redirect('', 'posts', 301);

Route::middleware('auth')
    ->resource('categories', CategoriesController::class)
    ->except(['show']);
Route::middleware('auth')
    ->resource('posts', ArticlesController::class);
