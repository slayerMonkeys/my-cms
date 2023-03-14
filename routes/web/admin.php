<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::resource('posts', PostController::class)->except('show');
Route::get('/posts/{post}', [PostController::class, 'delete'])->name('posts.delete');

Route::get('/profile/{user}', [UserController::class, 'showProfile'])->name('users.profile');

Route::resource('users', UserController::class)->except('show');
Route::resource('roles', RoleController::class)->except('show');
Route::resource('tags', TagController::class)->except('show');

