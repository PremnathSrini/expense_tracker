<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\user\BillController;
use App\Http\Controllers\user\TransactionController;
use App\Http\Controllers\user\UserAuthController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserEmailVerificationController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthUser;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'login'])->name('admin.auth');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware([AuthAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

/* Email Verification */
Route::middleware(['web'])->group(function () {
    Route::get('/email-verify/{id}/{hash}', [UserEmailVerificationController::class, 'verify'])->name('custom.verification');
});

Route::get('/expense-pie', function () {
        $transaction = Transaction::with('category')->pluck('amount','category_id');
        $data['labels'] = $transaction->keys();
        $data['prices'] = $transaction->values();
    return view('admin.chart', $data);
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});


/* User */
// Route::get('/', function () {
//     return view('user.login');
// })->name('login.form');
Route::get('/', [UserAuthController::class, 'showLoginForm'])->name('user.loginForm');
Route::get('register', [UserAuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [UserAuthController::class, 'register'])->name('user.register');
Route::post('login', [UserAuthController::class, 'login'])->name('user.login');
Route::delete('logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::middleware([AuthUser::class])->group(function(){
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.index');
    Route::post('/fetch-data', [UserController::class, 'fetchData'])->name('fetch-data');

    /* Transactions */
    Route::get('transactions', [TransactionController::class, 'index'])->name('user.transactions');
    Route::get('transaction/add', [TransactionController::class, 'create'])->name('user.transaction.create');
    Route::post('transaction/store', [TransactionController::class, 'store'])->name('user.transaction.store');
    Route::get('transaction/{transactionId}/edit', [TransactionController::class, 'edit'])->name('user.transaction.edit');
    Route::patch('transaction/{transactionId}/update', [TransactionController::class, 'update'])->name('user.transaction.update');
    Route::delete('transaction/{transactionId}/delete', [TransactionController::class, 'destroy'])->name('user.transaction.delete');

    /* Bills */
    Route::get('bills',[BillController::class,'index'])->name('user.bills');
    Route::get('bill/add',[BillController::class,'create'])->name('user.bill.create');
    Route::post('bill/store',[BillController::class,'store'])->name('user.bill.store');
    Route::get('bill/{billId}/edit',[BillController::class,'edit'])->name('user.bill.edit');
    Route::patch('bill/{billId}/update',[BillController::class,'update'])->name('user.bill.update');
    Route::delete('/bill/{bilId}/destroy',[BillController::class,'destroy'])->name('user.bill.destroy');
    /* Route::patch('bill/{billId}/update',[BillController::class,'update'])->name('user.bill.update');
    user.bill.mark-as-paid */
    Route::get('/coming-soon',function(){
        return view('user.coming-soon');
    });
});
