<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', [HomeController::class, 'home'])->name('home');

// Route::get('/', [AuthController::class, 'login'])->name('home');
//auth
Route::get('/login', [AuthController::class, 'login'])->name('login.view');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register.view');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
Route::get('/reset-password/email', [AuthController::class, 'resetPasswordEmail'])->name('reset.password.email');
Route::post('/reset-password/email', [AuthController::class, 'resetPasswordEmailPost'])->name('reset.password.email.post');
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.view');
Route::post('/reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password');
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/profile/transaction/detail/{no_inv}', [UserController::class, 'detailTransaction'])->name('user.transaction.detailold');
Route::get('/transaction', [UserController::class, 'transaction'])->name('user.transaction');
Route::get('/transaction/detail/{no_inv}', [UserController::class, 'detailTransaction'])->name('user.transaction.detail');

//ppob
Route::controller(ProductController::class)->name('product')->prefix('product')->group(function () {
    Route::get('/pulsa', 'pulsa')->name('.pulsa');
    Route::get('/data', 'data')->name('.data');
    Route::get('/bpjs', 'bpjs')->name('.bpjs');
    Route::get('/pdam', 'pdam')->name('.pdam');
    Route::get('/pln', 'pln')->name('.pln');
    Route::get('/tv-internet', 'tvInternet')->name('.tvInternet');
});
Route::post('/ajax/ppob', [ProductController::class, 'ajaxPpob']);

//hostel
Route::controller(HostelController::class)->name('hostel')->prefix('hostel')->group(function () {
    Route::get('/', 'index')->name('.index');
});


//tranas
Route::post('/cart', [TransactionController::class, 'cart'])->name('cart');
Route::post('/request/ppob', [TransactionController::class, 'requestPpob'])->name('request.ppob');
