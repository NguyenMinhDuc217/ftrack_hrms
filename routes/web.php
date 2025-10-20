<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminMennuController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRoleController;
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
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:super_admin|hr_manager'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/add', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/add', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user_id}', [AdminUserController::class, 'show'])->name('users.show');
    Route::post('/users/{user_id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::get('/changeDepartment/{department_id?}', [AdminUserController::class, 'changeDepartment'])->name('users.changeDepartment');
    Route::get('/departments', [AdminDepartmentController::class, 'index'])->name('departments');

    //route roles
    Route::get('/roles', [AdminRoleController::class, 'index'])->name('role.index');

    //route permissions
    Route::get('/permissions', [AdminPermissionController::class, 'index'])->name('permission.index');

    //Route Menu
    Route::get('/menus', [AdminMennuController::class, 'index'])->name('menu.index');
});
