<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\UserController;

// ホームページ（一覧表示）
Route::get('/', [PostController::class, 'index'])->name('home');

// 投稿関連（一覧・詳細・作成・編集・削除）
Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});

// レビュー関連（作成・削除・編集）
Route::middleware('auth')->group(function () {
    Route::post('/reviews/{post}', [ReviewController::class, 'store']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
});

// お気に入り機能
Route::middleware('auth')->group(function () {
    Route::post('/favorites/{post}/toggle', [FavoriteController::class, 'toggle']);
    Route::get('/favorites', [FavoriteController::class, 'index']);
});

// ランキング（週・月・年単位で取得）
Route::get('/rankings', [RankingController::class, 'index']);

// ユーザープロフィール管理（取得・更新）
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'show']);
    Route::put('/profile', [UserController::class, 'update']);
});

// 認証関連（Laravelの標準機能を利用）
require __DIR__ . '/auth.php';
