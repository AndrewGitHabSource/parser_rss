<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;

Route::get('/', [Controllers\HomeController::class, 'index']);
Route::get('/test', [Controllers\HomeController::class, 'test']);
Route::post('/auth/login', [Controllers\AuthController::class, 'login'])->name("login");
Route::get('/auth/user', [Controllers\AuthController::class, 'user'])->name("user");

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('/posts', [Controllers\Admin\PostController::class, 'index'])->name('admin.posts');
});
