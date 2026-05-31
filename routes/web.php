<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// ログインしないと入れない(投稿・編集・削除)
Route::middleware('auth')->group(function () {
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    Route::resource('threads', ThreadController::class)->except(['index', 'show']);
    //postでデータを送る。送る先がthreadのidの部分。のURLに届いたら ThreadController の storeReply というメソッドに渡す。
    // URLが /threads/{thread}/replies で POSTなら storeReplyへ！
    //name('replies.store') の役割。route('replies.store', $thread) と書くだけで/threads/3/replies というURLを自動で作ってくれる便利機能！
    Route::post('/threads/{thread}/replies',[ThreadController::class,'storeReply'])->name('replies.store'); 
});

// // 誰でも見れる部分（一覧・詳細）
Route::resource('recipes', RecipeController::class)->only(['index', 'show']);
Route::resource('threads', ThreadController::class)->only(['index', 'show']);

// 認証
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
