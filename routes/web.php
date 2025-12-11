<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminMennuController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CvProfileController;
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

    Route::get('/profile', [CvProfileController::class, 'index'])->name('profile');
    Route::post('/profile/save-summary', [CvProfileController::class, 'saveSummary'])->name('profile.save.summary');
    Route::post('/profile/save-experience', [CvProfileController::class, 'saveExperience'])->name('profile.save.experience');
    Route::delete('/profile/delete-experience/{id}', [CvProfileController::class, 'deleteExperience'])->name('profile.delete.experience');
    Route::get('/profile/get-education/{id}', [CvProfileController::class, 'getEducation'])->name('profile.get.education');
    Route::post('/profile/save-education', [CvProfileController::class, 'saveEducation'])->name('profile.save.education');
    Route::delete('/profile/delete-education/{id}', [CvProfileController::class, 'deleteEducation'])->name('profile.delete.education');
    Route::post('/profile/save-skill', [CvProfileController::class, 'saveSkill'])->name('profile.save.skill');
    Route::delete('/profile/delete-skill/{id}', [CvProfileController::class, 'deleteSkill'])->name('profile.delete.skill');
    Route::post('/profile/save-skill-group', [CvProfileController::class, 'saveSkillGroup'])->name('profile.save.skill-group');
    Route::delete('/profile/delete-skill-group', [CvProfileController::class, 'deleteSkillGroup'])->name('profile.delete.skill-group');
    Route::post('/profile/save-language', [CvProfileController::class, 'saveLanguage'])->name('profile.save.language');
    Route::delete('/profile/delete-language/{id}', [CvProfileController::class, 'deleteLanguage'])->name('profile.delete.language');
    Route::post('/profile/save-project', [CvProfileController::class, 'saveProject'])->name('profile.save.project');
    Route::delete('/profile/delete-project/{id}', [CvProfileController::class, 'deleteProject'])->name('profile.delete.project');
    Route::post('/profile/save-certificate', [CvProfileController::class, 'saveCertificate'])->name('profile.save.certificate');
    Route::delete('/profile/delete-certificate/{id}', [CvProfileController::class, 'deleteCertificate'])->name('profile.delete.certificate');
    Route::post('/profile/save-award', [CvProfileController::class, 'saveAward'])->name('profile.save.award');
    Route::delete('/profile/delete-award/{id}', [CvProfileController::class, 'deleteAward'])->name('profile.delete.award');

    // CV Management
    Route::get('/cv-manage', [App\Http\Controllers\CvManagementController::class, 'index'])->name('cv.manage');
    Route::post('/cv-manage/upload', [App\Http\Controllers\CvManagementController::class, 'upload'])->name('cv.upload');
    Route::delete('/cv-manage/delete/{id}', [App\Http\Controllers\CvManagementController::class, 'delete'])->name('cv.delete');
    
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:super_admin|admin|hr_manager', 'check.permission'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // route users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/user-add', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/user-add', [AdminUserController::class, 'update'])->name('users.store');
    Route::get('/users/{user_id}', [AdminUserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::post('/users/delete/{user_id}', [AdminUserController::class, 'delete'])->name('users.delete');

    // route departments
    Route::get('/changeDepartment/{department_id?}', [AdminUserController::class, 'changeDepartment'])->name('users.changeDepartment');
    Route::get('/departments', [AdminDepartmentController::class, 'index'])->name('departments');

    // route blogs
    Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs.index');
    Route::get('/job-add', [AdminJobController::class, 'create'])->name('jobs.create');
    Route::post('/job-add', [AdminJobController::class, 'update'])->name('jobs.store');
    Route::get('/jobs/{job_id}', [AdminJobController::class, 'show'])->name('jobs.show');
    Route::patch('/jobs/{job}', [AdminJobController::class, 'update'])->name('jobs.update');
    Route::post('/jobs/delete/{job_id}', [AdminJobController::class, 'delete'])->name('jobs.delete');

    // route blogs
    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
    Route::get('/blog-add', [AdminBlogController::class, 'create'])->name('blogs.create');
    Route::post('/blog-add', [AdminBlogController::class, 'update'])->name('blogs.store');
    Route::get('/blogs/{blog_id}', [AdminBlogController::class, 'show'])->name('blogs.show');
    Route::patch('/blogs/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
    Route::post('/blogs/delete/{blog_id}', [AdminBlogController::class, 'delete'])->name('blogs.delete');

    // route roles
    Route::get('/roles', [AdminRoleController::class, 'index'])->name('role.index');
    Route::get('/roles/create', [AdminRoleController::class, 'create'])->name('role.create');
    Route::post('/roles/create', [AdminRoleController::class, 'store'])->name('role.store');
    Route::get('/roles/edit/{id}', [AdminRoleController::class, 'edit'])->name('role.edit');
    Route::post('/roles/edit/{id}', [AdminRoleController::class, 'update'])->name('role.update');
    Route::post('/roles/delete/{id}', [AdminRoleController::class, 'delete'])->name('role.delete');
    Route::put('roles/{role}/permissions', [AdminRoleController::class, 'updatePermissions'])->name('role.permissions.update');
    // route permissions
    Route::get('/permissions', [AdminPermissionController::class, 'index'])->name('permission.index');

    // Route Menu
    Route::get('/menus', [AdminMennuController::class, 'index'])->name('menu.index');

    // File Management
    Route::get('files/upload', [App\Http\Controllers\Admin\AdminFileController::class, 'index'])->name('files.upload');
    Route::post('files/store', [App\Http\Controllers\Admin\AdminFileController::class, 'store'])->name('files.store');
});
