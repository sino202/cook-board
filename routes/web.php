<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// ログインしないと入れない
Route::middleware('auth')->group(function () {
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    Route::resource('threads', ThreadController::class)->except(['index', 'show']);
});

// 誰でも見れる（showより先にcreateが来るように、middlewareの後に書く）
Route::resource('recipes', RecipeController::class)->only(['index', 'show']);
Route::resource('threads', ThreadController::class)->only(['index', 'show']);

// 認証
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');