<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// হোমপেজ (সবাই দেখতে পারবে)
Route::get('/', [FrontendController::class, 'index'])->name('home');

// ড্যাশবোর্ড (লগইন লাগবে)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/expenses', [DashboardController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [DashboardController::class, 'store'])->name('expenses.store');
    Route::put('/expenses/{expense}', [DashboardController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [DashboardController::class, 'destroy'])->name('expenses.destroy');
});

// প্রোফাইল রুট
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';