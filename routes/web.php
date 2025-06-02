<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportCategoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReportStatusController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserReportController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/Report', [UserReportController::class , 'index'])->name('userReport');
Route::get('/Report/{code}', [UserReportController::class, 'show'])->name('userReport.show');

Route::get('/email/verify', function () {
        return view('pages.auth.verify-email');
    })->middleware('auth')->name('verification.notice');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class , 'index'])->name('home');




    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{id}/edit', [RegisterController::class, 'editUser'])->name('profile.edit');
    Route::put('/profile/{id}/update', [RegisterController::class, 'store'])->name('profile.store');

    Route::get('/UserReport/take', [UserReportController::class, 'take'])->name('userReport.take');
    Route::get('/UserReport/take/preview', [UserReportController::class, 'preview'])->name('userReport.preview');
    Route::get('/UserReport/create', [UserReportController::class, 'create'])->name('userReport.create');
    Route::post('/UserReport/store', [UserReportController::class, 'store'])->name('userReport.store');
    Route::get('/UserReport/success', [UserReportController::class, 'success'])->name('userReport.success');
    Route::get('/myReport', [UserReportController::class, 'myReport'])->name('myReport');

});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin' , ])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/resident', ResidentController::class);
    Route::resource('/Category' , ReportCategoryController::class);
    Route::resource('/Report', ReportController::class);
    Route::get('/Report/{ReportId}/Status/Create', [ReportStatusController::class, 'create'])->name('ReportStatus.Create');
    Route::resource('/ReportStatus', ReportStatusController::class);


});
