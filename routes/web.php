<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


// Client Routes
Route::get('/', [ClientController::class, 'index'])->name('client.home');

// Add more client routes here if you have other pages

// Guest-only Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Authenticated Client Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout'); // Logout is a POST request

    Route::get('/client-dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/client-profile', [ClientController::class, 'profile'])->name('client.profile');
    // Add more routes for authenticated client features (e.g., /my-orders, /settings)
});

// Admin Routes
// These routes should be protected. 'auth' middleware checks if user is logged in.
// 'can:access-admin' would be a custom authorization gate/policy you define
// to check if the logged-in user *is an admin*.
Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:access-admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Add more admin-specific routes here (e.g., users, products, settings)
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{user_id}', [AdminUserController::class, 'show'])->name('users.show');

});