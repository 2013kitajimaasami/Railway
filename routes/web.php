<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// ダッシュボードをindex表示にする
Route::get('/dashboard', [SpotController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/spot/create', [SpotController::class, 'create'])->name('spot.create');
Route::post('/spot/store', [SpotController::class, 'store'])->name('spot.store');
Route::get('/spot/index', [SpotController::class, 'index'])->name('spot.index');
Route::get('/spot/{spot}', [SpotController::class, 'show'])->name('spot.show');
Route::get('/spot/{spot}/edit', [SpotController::class, 'edit'])->name('spot.edit');
Route::patch('/spot/{spot}', [SpotController::class, 'update'])->name('spot.update');
Route::delete('/spot/{spot}', [SpotController::class, 'destroy'])->name('spot.destroy');

Route::post('/spot/comment/store', [CommentController::class, 'store'])->name('comment.store');

require __DIR__.'/auth.php';
