<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HogwartsProphetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;

// Public Controllers
use App\Http\Controllers\FacilityController as PublicFacilityController;

// Admin Controllers
use App\Http\Controllers\Admin\FacilityCategoryController;
use App\Http\Controllers\Admin\FacilityPhotoController;
use App\Http\Controllers\Admin\HogwartsProphetController as AdminHogwartsProphetController;
use App\Http\Controllers\Admin\HouseController;
use App\Http\Controllers\Admin\ProfessorController;
use App\Http\Controllers\Admin\AchievementController;

/* ===================
   Public Pages
=================== */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/hogwarts-prophet', [HogwartsProphetController::class, 'publicIndex'])->name('hogwarts-prophet.index');
Route::get('/fasilitas', [PublicFacilityController::class, 'index'])->name('facilities.index');
Route::get('/fasilitas/{slug}', [PublicFacilityController::class, 'show'])->name('facilities.show');

/* ===================
   Admin Authentication
=================== */
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/* ===================
   Admin Pages (Login Required)
=================== */
Route::middleware(['auth.admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('hogwarts-prophet', AdminHogwartsProphetController::class);
    Route::prefix('facilities')->name('facilities.')->group(function () {
        Route::resource('categories', FacilityCategoryController::class);
        Route::prefix('categories/{category}/photos')->name('categories.photos.')->group(function () {
            Route::get('/create', [FacilityPhotoController::class, 'create'])->name('create');
            Route::post('/', [FacilityPhotoController::class, 'store'])->name('store');
        });
    });

    Route::resource('houses', HouseController::class)->only(['index', 'edit', 'update']);
    Route::post('houses/{house}/students', [HouseController::class, 'storeStudents'])->name('houses.storeStudents');
    Route::post('houses/{house}/achievements', [HouseController::class, 'storeAchievement'])->name('houses.storeAchievement');

    Route::resource('professors', ProfessorController::class);
    Route::resource('achievements', AchievementController::class);
    Route::resource('students', \App\Http\Controllers\Admin\StudentController::class);

    Route::get('/school-profile', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'index'])->name('school-profile.index');
    Route::get('/school-profile/edit', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'edit'])->name('school-profile.edit');
    Route::put('/school-profile', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'update'])->name('school-profile.update');
});
