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
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;


// Client Routes
Route::get('/', [ClientController::class, 'index'])->name('client.home');

Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::get('/auth/google/redirect', [LoginController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [LoginController::class, 'callback'])->name('google.callback');
});

// Authenticated Client Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/client-dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/client-profile', [ClientController::class, 'profile'])->name('client.profile');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:super_admin|admin|hr_manager', 'check.permission'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/add', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/add', [AdminUserController::class, 'update'])->name('users.store');
    Route::get('/users/{user_id}', [AdminUserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::post('/users/delete/{user_id}', [AdminUserController::class, 'delete'])->name('users.delete');

    Route::get('/changeDepartment/{department_id?}', [AdminUserController::class, 'changeDepartment'])->name('users.changeDepartment');
    Route::get('/departments', [AdminDepartmentController::class, 'index'])->name('departments');

    //route roles
    Route::get('/roles',                    [AdminRoleController::class, 'index' ])->name('role.index');
    Route::get('/roles/create',             [AdminRoleController::class, 'create'])->name('role.create');
    Route::post('/roles/create',            [AdminRoleController::class, 'store' ])->name('role.store');
    Route::get('/roles/edit/{id}',          [AdminRoleController::class, 'edit'  ])->name('role.edit');
    Route::post('/roles/edit/{id}',         [AdminRoleController::class, 'update'])->name('role.update');
    Route::post('/roles/delete/{id}',       [AdminRoleController::class, 'delete'])->name('role.delete');
    Route::put('roles/{role}/permissions',  [AdminRoleController::class, 'updatePermissions'])->name('role.permissions.update');
    //route permissions
    Route::get('/permissions', [AdminPermissionController::class, 'index'])->name('permission.index');

    //Route Menu
    Route::get('/menus', [AdminMennuController::class, 'index'])->name('menu.index');
});
