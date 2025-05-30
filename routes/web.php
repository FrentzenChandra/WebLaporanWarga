<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportCategoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\admin\ReportStatusController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserReportController;
use App\Models\ReportStatus;



Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/Report', [UserReportController::class , 'index'])->name('userReport');
Route::get('/Report/{code}', [UserReportController::class, 'show'])->name('userReport.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class , 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/UserReport/take', [UserReportController::class, 'take'])->name('userReport.take');
    Route::get('/UserReport/take/preview', [UserReportController::class, 'preview'])->name('userReport.preview');
    Route::get('/UserReport/create', [UserReportController::class, 'create'])->name('userReport.create');
    Route::post('/UserReport/store', [UserReportController::class, 'store'])->name('userReport.store');
    Route::get('/UserReport/success', [UserReportController::class, 'success'])->name('userReport.success');
    Route::get('/myReport', [UserReportController::class, 'myReport'])->name('myReport');

});




Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/resident', ResidentController::class);
    Route::resource('/Category' , ReportCategoryController::class);
    Route::resource('/Report', ReportController::class);
    Route::get('/Report/{ReportId}/Status/Create', [ReportStatusController::class, 'create'])->name('ReportStatus.Create');
    Route::resource('/ReportStatus', ReportStatusController::class);


});
