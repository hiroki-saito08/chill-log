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

Route::get('/', [IndexController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('post', PostController::class)->middleware(['auth', 'verified']);
    Route::resource('review', ReviewController::class)->middleware(['auth', 'verified']);
    Route::resource('favorite', FavoriteController::class)->middleware(['auth', 'verified']);
    Route::resource('image', ImageController::class)->middleware(['auth', 'verified']);
});

require __DIR__ . '/auth.php';
