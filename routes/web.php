<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


// Client Routes
Route::get('/', [ClientController::class, 'index'])->name('client.home');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Authenticated Client Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/client-dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/client-profile', [ClientController::class, 'profile'])->name('client.profile');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:super-admin|hr_manager'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{user_id}', [AdminUserController::class, 'show'])->name('users.show');
});
