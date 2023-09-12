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
use App\Http\Controllers\Partner\RiwayatBookingController;
use App\Http\Controllers\PartnerHotelController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Partner\DashboardPartnerController;
use App\Http\Controllers\Partner\ManagementHotelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as ProductAdminController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/partner-hotel', [PartnerHotelController::class, 'index'])->name('partner.hotel');

// Route::get('/', [AuthController::class, 'login'])->name('home');
//auth
//Route::get('/login', [AuthController::class, 'login'])->name('login.view');
//Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
//Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//Route::get('/register', [AuthController::class, 'register'])->name('register.view');
//Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
//Route::get('/reset-password/email', [AuthController::class, 'resetPasswordEmail'])->name('reset.password.email');
//Route::post('/reset-password/email', [AuthController::class, 'resetPasswordEmailPost'])->name('reset.password.email.post');
//Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.view');
//Route::post('/reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password');
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/profile/transaction/detail/{no_inv}', [UserController::class, 'detailTransaction'])->name('user.transaction.detailold');
Route::get('/transaction', [UserController::class, 'transaction'])->name('user.transaction');
Route::get('/transaction/detail/{no_inv}', [UserController::class, 'detailTransaction'])->name('user.transaction.detail');

//ppob
Route::controller(ProductController::class)->name('product')->prefix('product')->group(function () {
    Route::get('/pulsa', 'pulsa')->name('.pulsa');

    Route::get('/{category}/{provider}', 'pulsaData');
    Route::get('/payment-pulsa-data', 'paymentPulsaData')->name('.payment.pulsa.data');

    Route::get('/data', 'data')->name('.data');
    // Route::get('/bpjs', 'bpjs')->name('.bpjs');
    // Route::get('/pdam', 'pdam')->name('.pdam');
    // Route::get('/pln', 'pln')->name('.pln');

    Route::post('/bpjs', 'bpjs')->name('.bpjs');
    Route::get('/payment-bpjs', 'paymentBpjs')->name('.payment.bpjs');

    Route::post('/pln', 'pln')->name('.pln');
    Route::get('/payment-pln', 'paymentPln')->name('.payment.pln');

    Route::post('/pdam', 'pdam')->name('.pdam');
    Route::get('/product-pdam', 'productPdam')->name('.product.pdam');
    Route::get('/payment-pdam', 'paymentPdam')->name('.payment.pdam');

    Route::post('/tv-internet', 'tvInternet')->name('.tvInternet');
    Route::get('/product-tv-internet', 'productTvInternet')->name('.product.tvInternet');
    Route::get('/payment-tv-internet', 'paymentTvInternet')->name('.payment.tvInternet');
});
Route::prefix('checkout')->group(function () {
    Route::get('detail/product/{product}', [ProductController::class, 'show'])->name('checkout.product');
    Route::get('dashboard', [DashboardPartnerController::class, 'index'])->name('partner.dashboard');
    Route::get('riwayat-booking', [RiwayatBookingController::class, 'index'])->name('partner.riwayat-booking');
});
Route::post('/ajax/ppob', [ProductController::class, 'ajaxPpob']);

//hotel
Route::controller(HotelController::class)->name('hotels')->prefix('hotels')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/list-hotel', 'listHotel')->name('.list-hotel');
    //    Route::get('/detail-hotel', 'show')->name('.show');
    Route::get('/{id_hotel}/room', 'room')->name('.room');
    Route::get('/reservation-example/', 'reservationExample')->name('.reservation.example');
    Route::get('/{idroom}/reservation', 'reservation')->name('.reservation');
    Route::post('/{idroom}/request', 'request')->name('.request');
    Route::get('/ajax/city', 'ajaxCity')->name('.ajax.city');
    Route::post('/ajax', 'ajaxHotel');
});


//hostel
Route::controller(HostelController::class)->name('hostel')->prefix('hostel')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/{id}/room/', 'room')->name('.room');
    Route::get('/{idroom}/checkout', 'checkout')->name('.checkout');
    Route::post('/{idroom}/request', 'request')->name('.request');
    Route::get('/ajax/city', 'ajaxCity')->name('.ajax.city');
    Route::post('/ajax', 'ajaxHostel');
});


//tranas
Route::get('/cart', [TransactionController::class, 'cart'])->name('cart');
Route::post('/request/ppob', [TransactionController::class, 'requestPpob'])->name('request.ppob');
Route::get('reservation', [TransactionController::class, 'reservation'])->name('reservation.hotel');

Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role'])->group(function () {
    Route::middleware('admin')->group(function () {

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::prefix('management-mitra')->group(function () {
                Route::resource('hotel', \App\Http\Controllers\Admin\HotelController::class);
                Route::resource('hostel', \App\Http\Controllers\Admin\HostelController::class);
                Route::get('hostel/{hostel}', [\App\Http\Controllers\Admin\HostelController::class, 'show'])->name('hostel.show');
                Route::put('/put-hostel', [HostelController::class, 'updateAjax'])->name('hostel.update.ajax');
            });

            Route::get('user', [AdminUserController::class, 'index'])->name('user');
            Route::post('user', [AdminUserController::class, 'create'])->name('user.create');
            Route::post('user/edit', [AdminUserController::class, 'editJson'])->name('user.edit');
            Route::put('user/update', [AdminUserController::class, 'update'])->name('user.update');
            Route::get('user/{id}/delete', [AdminUserController::class, 'delete'])->name('user.delete');

            //management-mitra
            Route::get('mitra', [MitraController::class, 'index'])->name('mitra');
            Route::put('mitra', [MitraController::class, 'updateMitra'])->name('mitra.update');
            Route::post('mitra', [MitraController::class, 'storeMitra'])->name('mitra.store');
            Route::delete('mitra/{id}/delete', [MitraController::class, 'destroyMitra'])->name('mitra.destroy');


            //point
            Route::get('point', [PointController::class, 'index'])->name('point');
            Route::put('point', [PointController::class, 'updatePoint'])->name('point.update');
            Route::post('point', [PointController::class, 'storePoint'])->name('point.store');

            //management-fee
            Route::get('management-fee', [FeeController::class, 'index'])->name('management-fee');
            Route::put('management-fee', [FeeController::class, 'updateFee'])->name('management-fee.update');
            Route::post('management-fee', [FeeController::class, 'storeFee'])->name('management-fee.store');

            //Product
            //                Route::resource('product', ProductAdminController::class);
            Route::get('product', [ProductAdminController::class, 'index'])->name('product');
            Route::get('product/edit-data', [ProductAdminController::class, 'edit'])->name('product.edit');
            Route::post('product/update-product', [ProductAdminController::class, 'update'])->name('product.update-product');

            //                //management-fee
            //                Route::get('management-fee', [FeeController::class, 'index'])->name('management-fee');
            //                Route::put('management-fee', [FeeController::class, 'updateFee'])->name('management-fee.update');
            //                Route::post('management-fee', [FeeController::class, 'storeFee'])->name('management-fee.store');

            //customer
            Route::get('customer', [CustomerController::class, 'index'])->name('customer');

            // Admin
            //dashboard
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            //transaction
            Route::get('transaction', [AdminTransactionController::class, 'index'])->name('transaction');
            // Route::post('transaction/', [AdminTransactionController::class, 'store'])->name('transaction.store');
            Route::get('transaction/{id}/detail', [AdminTransactionController::class, 'detail'])->name('transaction.detail');
            Route::put('transaction/detail/update', [AdminTransactionController::class, 'detailUpdate'])->name('transaction.detail.update');

            //            Route::resource('hostel',[\App\Http\Controllers\Admin\HostelController::class]);
            //            //hostel
            //            Route::get('hostel', [AdminHostelController::class, 'index'])->name('hostel');
            //            Route::get('hostel/{id}', [AdminHostelController::class, 'show'])->name('hostel.show');
            //            Route::post('hostel/main-image', [AdminHostelController::class, 'mainImage'])->name('hostel.main-image');
            //            Route::delete('hostel/delete-image', [AdminHostelController::class, 'deleteImage'])->name('hostel.delete-image');
            //            Route::get('hostel/{id}/edit', [AdminHostelController::class, 'edit'])->name('hostel.edit');
            //            Route::put('hostel/{id}/update', [AdminHostelController::class, 'update'])->name('hostel.update');
            //            Route::get('hostel/{id}/image', [AdminHostelController::class, 'showImage'])->name('hostel.image');
            //            Route::post('hostel/store-image', [AdminHostelController::class, 'storeImage'])->name('hostel.store-image');


            //hostel ajax
            //            Route::post('hostel-room/ajax', [MitraController::class, 'hostelRoomAjax'])->name('hostelroom.ajax');
        });
        //user

    });

    Route::prefix('partner')->namespace('partner')->group(function () {
        Route::get('dashboard', [DashboardPartnerController::class, 'index'])->name('partner.dashboard');
        Route::get('riwayat-booking', [RiwayatBookingController::class, 'index'])->name('partner.riwayat-booking');


        Route::prefix('management-hotel')->group(function () {
            Route::get('', [ManagementHotelController::class, 'index'])->name('partner.management.hotel');
            Route::get('detail-hotel/{id}', [ManagementHotelController::class, 'detailHotel'])->name('partner.management.hotel.detail');
            //            Route::get('detail-hotel/{hotel}', [ManagementHotelController::class, 'index'])->name('partner.management.hotel');
            Route::get('setting-hotel-information/{id}', [ManagementHotelController::class, 'settingHotel'])->name('partner.management.hotel.setting.hotel');
            Route::get('setting-hotel-photo/{id}', [ManagementHotelController::class, 'settingPhoto'])->name('partner.management.hotel.setting.photo');
            Route::get('setting-hotel-room/{id}', [ManagementHotelController::class, 'settingRoom'])->name('partner.management.hotel.setting.room');
            Route::get('setting-hotel-room/create/{id}', [ManagementHotelController::class, 'settingRoomCreate'])->name('partner.management.hotel.setting.room.create');
            Route::post('setting-hotel-room/post', [ManagementHotelController::class, 'settingRoomPost'])->name('partner.management.hotel.setting.room.post');
            Route::delete('setting-hotel-room/delete/{id}', [ManagementHotelController::class,'settingRoomDelete'])->name('partner.management.setting.room.delete');
            Route::get('setting-hotel-room/hotel-room/{hotel_id}/{id}', [ManagementHotelController::class,'settingRoomShow'])->name('partner.management.setting.room.show');
            Route::post('setting-hotel-room/hotel-room/update/{hotel_id}/{id}', [ManagementHotelController::class,'settingRoomUpdate'])->name('partner.management.setting.room.update');
        });
    });
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
