<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::post('/auth/login', [Controllers\AuthController::class, 'login'])->name("login");
Route::get('/auth/user', [Controllers\AuthController::class, 'user'])->name("user");

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::post('/posts', [Controllers\Admin\PostController::class, 'index'])->name('admin.posts');
    Route::post('/search', [Controllers\Admin\PostController::class, 'search'])->name('admin.search');
    Route::get('/post/get', [Controllers\Admin\PostController::class, 'getPost'])->name('admin.get.post');
    Route::post('/image/upload', [Controllers\Admin\PostController::class, 'uploadImage'])->name('admin.upload.image');
    Route::post('/post/updatePost', [Controllers\Admin\PostController::class, 'updatePost'])->name('admin.update.post');
    Route::post('/post/savePost', [Controllers\Admin\PostController::class, 'savePost'])->name('admin.save.post');
    Route::get('/post/delete', [Controllers\Admin\PostController::class, 'delete'])->name('admin.delete.post');
});
