<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontendController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    // Route::get('/', [DashboardController::class, 'bills']);

    // Frontend authenticated routes
Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [FrontendController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    
    // অন্যান্য frontend routes এখানে যোগ করুন
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';