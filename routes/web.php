<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;


// ホーム & 投稿一覧
Route::get('/', [PostController::class, 'index'])->name('home'); // トップページ
Route::get('/posts', [PostController::class, 'posts'])->name('posts'); // 投稿一覧
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // 投稿詳細
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // 投稿作成


// 認証ユーザーのみアクセス可能なルート
Route::middleware(['auth'])->group(function () {
    // マイページ関連
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::post('/mypage', [MypageController::class, 'update'])->name('mypage.update');

    // 投稿関連
    Route::prefix('posts')->group(function () {
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/own', [PostController::class, 'own'])->name('posts.own');
        Route::get('/favorites', [PostController::class, 'favorite'])->name('posts.favorite');
        Route::post('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    // レビュー関連
    Route::prefix('reviews')->group(function () {
        Route::post('/', [ReviewController::class, 'store'])->name('reviews.store');
        Route::put('/{review}', [ReviewController::class, 'update'])->name('reviews.update');
        Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    });

    // お気に入り関連
    Route::post('/favorite/{post}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{post}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
});

require __DIR__ . '/auth.php';
