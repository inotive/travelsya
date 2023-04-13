<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', [AuthController::class, 'login'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login.view');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register.view');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
Route::get('/reset-password/email', [AuthController::class, 'resetPasswordEmail'])->name('reset.password.email');
Route::post('/reset-password/email', [AuthController::class, 'resetPasswordEmailPost'])->name('reset.password.email.post');
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.view');
Route::post('/reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password');


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/product/pulsa', [ProductController::class, 'pulsa'])->name('product.pulsa');
Route::post('/ajax/ppob', [ProductController::class, 'ajaxPpob']);
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
