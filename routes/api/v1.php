<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ArticlesController;
use App\Http\Controllers\Api\V1\CategoriesController;

Route::apiResources([
    'categories' => CategoriesController::class,
    'posts' => ArticlesController::class
], [
    'middleware' => 'auth:api',
    'as' => 'api'
]);
