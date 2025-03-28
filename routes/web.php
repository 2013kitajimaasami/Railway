<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotController;
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

require __DIR__.'/auth.php';
