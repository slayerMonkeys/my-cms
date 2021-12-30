<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');

Route::middleware('auth')->group(function() {

    Route::prefix('admin')->group(function() {
        Route::get('/', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');
        Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
        Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
        Route::get('/post', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
        Route::delete('/post/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
        Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');
    });

});

