<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\HostelController as AdminHostelController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
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
Route::post('/ajax/hostel', [HostelController::class, 'ajaxHostel']);

//hostel
Route::controller(HostelController::class)->name('hostel')->prefix('hostel')->group(function () {
    Route::get('/', 'index')->name('.index');
});


//tranas
Route::post('/cart', [TransactionController::class, 'cart'])->name('cart');
Route::post('/request/ppob', [TransactionController::class, 'requestPpob'])->name('request.ppob');


Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role'])->group(function () {
    Route::middleware('admin')->group(function () {
        //user
        Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user');
        Route::post('/admin/user', [AdminUserController::class, 'create'])->name('admin.create');
        Route::post('/admin/user/edit', [AdminUserController::class, 'editJson'])->name('admin.edit');
        Route::put('/admin/user/update', [AdminUserController::class, 'update'])->name('admin.update');
        Route::get('/admin/user/{id}/delete', [AdminUserController::class, 'delete'])->name('admin.delete');

        //mitra
        Route::get('/admin/mitra', [MitraController::class, 'index'])->name('admin.mitra');
        Route::put('/admin/mitra', [MitraController::class, 'updateMitra'])->name('admin.mitra.update');
        Route::post('/admin/mitra', [MitraController::class, 'storeMitra'])->name('admin.mitra.store');


        //point
        Route::get('/admin/point', [PointController::class, 'index'])->name('admin.point');
        Route::put('/admin/point', [PointController::class, 'updatePoint'])->name('admin.point.update');
        Route::post('/admin/point', [PointController::class, 'storePoint'])->name('admin.point.store');

        //fee
        Route::get('/admin/fee', [FeeController::class, 'index'])->name('admin.fee');
        Route::put('/admin/fee', [FeeController::class, 'updateFee'])->name('admin.fee.update');
        Route::post('/admin/fee', [FeeController::class, 'storeFee'])->name('admin.fee.store');

        //customer
        Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin.customer');
    });

    //dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //transaction
    Route::get('/admin/transaction', [AdminTransactionController::class, 'index'])->name('admin.transaction');
    Route::post('/admin/transaction/', [AdminTransactionController::class, 'store'])->name('admin.transaction.store');
    Route::get('/admin/transaction/{id}/detail', [AdminTransactionController::class, 'detail'])->name('admin.transaction.detail');
    Route::put('/admin/transaction/detail/update', [AdminTransactionController::class, 'detailUpdate'])->name('admin.transaction.detail.update');

    //hostel
    Route::get('admin/hostel', [AdminHostelController::class, 'index'])->name('admin.hostel');
    Route::get('admin/hostel/{id}', [AdminHostelController::class, 'show'])->name('admin.hostel.show');

    //hostel ajax
    Route::post('/admin/hostel-room/ajax', [MitraController::class, 'hostelRoomAjax'])->name('admin.hostelroom.ajax');
});
