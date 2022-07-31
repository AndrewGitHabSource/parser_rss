<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::post('/auth/login', [Controllers\AuthController::class, 'login'])->name("login");
Route::get('/auth/user', [Controllers\AuthController::class, 'user'])->name("user");

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/posts', [Controllers\Admin\PostController::class, 'index'])->name('admin.posts');
    Route::post('/filter', [Controllers\Admin\PostController::class, 'filter'])->name('admin.filter');
    Route::post('/search', [Controllers\Admin\PostController::class, 'search'])->name('admin.search');
});
