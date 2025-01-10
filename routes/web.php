<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\user\UserAuthController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserEmailVerificationController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login',[AuthController::class,'index'])->name('admin.login');
Route::post('/admin',[AuthController::class,'login'])->name('admin.auth');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware([AuthAdmin::class])->group(function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
});

/* Email Verification */
Route::middleware(['web'])->group(function(){
    Route::get('/email-verify/{id}/{hash}',[UserEmailVerificationController::class,'verify'])->name('custom.verification');
});

Route::get('/expense-pie',function(){
    $data = [
        'labels' =>  ['Food','Petrol','Entertainment','Shopping','Internet'],
        'prices' => [1000,800,400,1200,3000],
    ];
    return view('admin.chart',$data);
});

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});


/* User */
Route::get('/', function () {
    return view('user.login');
})->name('login.form');
Route::get('register',[UserAuthController::class,'showRegisterForm'])->name('register.form');
Route::post('register',[UserAuthController::class,'register'])->name('user.register');
Route::post('login',[UserAuthController::class,'login'])->name('user.login');
Route::get('logout',[UserAuthController::class,'logout'])->name('user.logout');
Route::get('/user/dashboard',[UserController::class,'index'])->name('user.index');

