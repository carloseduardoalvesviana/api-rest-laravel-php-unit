<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);

// User
Route::get('user/me', MeController::class)->middleware(['auth:sanctum']);

// Articles
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{article}', [ArticleController::class, 'show']);
Route::post('articles', [ArticleController::class, 'store']);
Route::put('articles/{article}', [ArticleController::class, 'update']);
Route::delete('articles/{article}', [ArticleController::class, 'delete']);
