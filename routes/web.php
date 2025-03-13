<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;

// テストページ
Route::get('/test', function () {
    return Inertia::render('Test');
});

// ホーム & 投稿一覧
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// 認証ユーザーのみアクセス可能なルート
Route::middleware(['auth'])->group(function () {
    // マイページ関連
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');

    // 投稿関連
    Route::prefix('posts')->group(function () {
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/own', [PostController::class, 'own'])->name('posts.own');
        Route::get('/favorites', [PostController::class, 'favorite'])->name('posts.favorite');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    // レビュー関連
    Route::prefix('reviews')->group(function () {
        Route::post('/', [ReviewController::class, 'store'])->name('reviews.store');
        Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    });

    // お気に入り関連
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

require __DIR__ . '/auth.php';
