<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('top');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// ダッシュボードをindex表示にする
// Route::get('/dashboard', [SpotController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [SpotController::class, 'index'])->name('dashboard');

    Route::get('/spot/myspot', [SpotController::class, 'myspot'])->name('spot.myspot');
    Route::get('/spot/mycomment', [SpotController::class, 'mycomment'])->name('spot.mycomment');

    Route::get('/spot/create', [SpotController::class, 'create'])->name('spot.create');
    Route::post('/spot/store', [SpotController::class, 'store'])->name('spot.store');
    Route::get('/spot/index', [SpotController::class, 'index'])->name('spot.index');
    Route::get('/spot/{spot}', [SpotController::class, 'show'])->name('spot.show');
    Route::get('/spot/{spot}/edit', [SpotController::class, 'edit'])->name('spot.edit');
    Route::patch('/spot/{spot}', [SpotController::class, 'update'])->name('spot.update');
    Route::delete('/spot/{spot}', [SpotController::class, 'destroy'])->name('spot.destroy');

    Route::post('/spot/comment/store', [CommentController::class, 'store'])->name('comment.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 管理者画面用
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/adminedit/{user}', [ProfileController::class, 'adminedit'])->name('profile.adminedit');
        Route::patch('/profile/adminupdate/{user}', [ProfileController::class, 'adminupdate'])->name('profile.adminupdate');
        Route::delete('/profile/{user}', [ProfileController::class, 'admindestroy'])->name('profile.admindestroy');
        Route::patch('/roles/{user}/attach', [RoleController::class, 'attach'])->name('role.attach');
        Route::patch('/role/{user}/detach', [RoleController::class, 'detach'])->name('role.detach');
    });
});

Route::middleware('auth')->group(function () {});









require __DIR__ . '/auth.php';
