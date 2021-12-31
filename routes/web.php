<?php

use App\Http\Controllers\PostsController;
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
Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');

Route::middleware('auth')->group(function() {

    Route::prefix('admin')->group(function() {
        Route::get('/', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');
        Route::resource('posts', PostsController::class)->except('show');
        Route::get('/posts/{post}', [PostsController::class, 'delete'])->name('posts.delete');

    });

});

