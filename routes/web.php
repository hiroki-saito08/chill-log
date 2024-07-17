<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChillControllers\ProfileController;
use App\Http\Controllers\ChillControllers\IndexController;
use App\Http\Controllers\ChillControllers\PostController;
use App\Http\Controllers\ChillControllers\ReviewController;
use App\Http\Controllers\ChillControllers\FavoriteController;
use App\Http\Controllers\ChillControllers\ImageController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test', function () {
    return Inertia::render('Test');
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts-search', [PostController::class, 'search'])->name('posts.search');
Route::post('/posts-search', [PostController::class, 'search'])->name('posts.search');
Route::get('/post-show/{post}', [PostController::class, 'show'])->name('post.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile-edit/{profile}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile-update/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-destroy/{profile}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/post-own', [PostController::class, 'own'])->name('post.own');
    Route::get('/post-favorite', [PostController::class, 'favorite'])->name('post.favorite');
    Route::get('/post-create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post-store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post-edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post-update/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post-destroy/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::resource('review', ReviewController::class)->middleware(['auth', 'verified']);
    Route::resource('favorite', FavoriteController::class)->middleware(['auth', 'verified']);
    Route::resource('image', ImageController::class)->middleware(['auth', 'verified']);
});

require __DIR__ . '/auth.php';
