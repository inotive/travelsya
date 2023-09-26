<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilitiesController;
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
use App\Http\Controllers\Partner\ManagementHostelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as ProductAdminController;
use App\Http\Controllers\Partner\ManagementRoomController;
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
Route::get('/favorite-hotel', [HotelController::class, 'favoriteHotel'])->name('favorite.hotel');
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
Route::get('/profile/order-history', [UserController::class, 'orderHistory'])->name('user.orderHistory');
Route::get('/profile/order-detail', [UserController::class, 'orderDetail'])->name('user.transactionDetail');
Route::get('/profile/help', [UserController::class, 'help'])->name('user.help');


Route::get('/profile/transaction/detail/{no_inv}', [UserController::class, 'detailTransaction'])->name('user.transaction.detailold');
Route::get('/transaction', [UserController::class, 'transaction'])->name('user.transaction');
Route::get('/transaction/detail/{no_inv}', [UserController::class, 'detailTransaction'])->name('user.transaction.detail');

//ppob
Route::controller(ProductController::class)->name('product')->prefix('product')->group(function () {
    Route::get('/pulsa', 'pulsa')->name('.pulsa');
    Route::get('/data', 'data')->name('.data');

    Route::get('/{category}/{provider}', 'pulsaData');
    Route::get('/payment-pulsa-data', 'paymentPulsaData')->name('.payment.pulsa.data');
    // Route::get('/bpjs', 'bpjs')->name('.bpjs');
    Route::get('/bpjs', 'bpjs')->name('.bpjs');
    // Route::get('/pdam', 'pdam')->name('.pdam');
    Route::get('/pdam', 'pdam')->name('.pdam');
    // Route::get('/pln', 'pln')->name('.pln');
    Route::get('/pln', 'pln')->name('.pln');
    Route::post('/bpjs', 'bpjs')->name('.bpjs');
    Route::get('/tv-internet', 'tvInternet')->name('.tvInternet');
    Route::get('/payment-bpjs', 'paymentBpjs')->name('.payment.bpjs');
    Route::post('/pln', 'pln')->name('.pln');
    Route::get('/payment-pln', 'paymentPln')->name('.payment.pln');
    Route::post('/pdam', 'pdam')->name('.pdam');
    Route::get('/product-pdam', 'productPdam')->name('.product.pdam');
    Route::get('/payment-pdam', 'paymentPdam')->name('.payment.pdam');
    Route::post('/tv-internet', 'tvInternet')->name('.tvInternet');
    Route::get('/product-tv-internet', 'productTvInternet')->name('.product.tvInternet');
    Route::get('/payment-tv-internet', 'paymentTvInternet')->name('.payment.tvInternet');

    Route::post('/tax', 'tax')->name('.tax');
    Route::get('/product-tax', 'productTax')->name('.product.tax');
    Route::get('/payment-tax', 'paymentTax')->name('.payment.tax');

    Route::post('/admin-fee', 'getAdminFee')->name('.adminFee');
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
    Route::get('/{idroom}/start/{start}/duration/{duration}/jumlah-kamar/{room}/jumlah-tamu/{guest}', 'checkout')->name('.checkout');
    Route::post('/{idroom}/request', 'request')->name('.request');
    Route::get('/ajax/city', 'ajaxCity')->name('.ajax.city');
    Route::post('/ajax', 'ajaxHostel');
});


//tranas
Route::post('/cart', [TransactionController::class, 'cart'])->name('cart');
Route::post('/request/ppob', [TransactionController::class, 'requestPpob'])->name('request.ppob');
Route::get('reservation', [TransactionController::class, 'reservation'])->name('reservation.hotel');

Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::prefix('management-mitra')->group(function (){
                Route::resource('hotel', \App\Http\Controllers\Admin\HotelController::class);
                Route::resource('hostel', \App\Http\Controllers\Admin\HostelController::class);
                Route::get('hostel/{hostel}/review', [\App\Http\Controllers\Admin\HostelController::class, 'review'])->name('hostel.review');
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

            //Facilities
            // Route::resource('facility', FacilitiesController::class);
            Route::get('facility', [FacilitiesController::class, 'index'])->name('facility.index');
            Route::get('facility/create', [FacilitiesController::class, 'create'])->name('facility.create');
            Route::post('facility', [FacilitiesController::class, 'store'])->name('facility.store');
            Route::get('facility/{facility}', [FacilitiesController::class, 'show'])->name('facility.show');
            Route::get('facility/{facility}/edit', [FacilitiesController::class, 'edit'])->name('facility.edit');
            Route::post('facility/{facility}', [FacilitiesController::class, 'update'])->name('facility.update');
            Route::delete('facility/{facility}', [FacilitiesController::class, 'destroy'])->name('facility.destroy');

            //customer
            Route::get('customer', [CustomerController::class, 'index'])->name('customer');

            //Ads
            // Route::resource('ads', AdController::class);
            Route::get('ads', [AdController::class, 'index'])->name('ads.index');
            Route::post('ads', [AdController::class, 'store'])->name('ads.store');
            Route::get('ads/{ad}', [AdController::class, 'show'])->name('ads.show');
            Route::get('ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
            Route::post('ads/{ad}', [AdController::class, 'update'])->name('ads.update');
            Route::delete('ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');

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
        Route::get('riwayat-booking/detail-booking/hotel/{id}', [RiwayatBookingController::class, 'detailhotelbookdate'])->name('partner.riwayat-booking.detailhotel');
        Route::get('riwayat-booking/detail-booking/hostel/{id}', [RiwayatBookingController::class, 'detailhostelbookdate'])->name('partner.riwayat-booking.detailhostel');
        Route::get('laporan/semua', [\App\Http\Controllers\Partner\LaporanController::class, 'index'])->name('partner.laporan.semua');


        Route::get('daftar-room', [ManagementRoomController::class, 'index'])->name('partner.management.room');
        Route::get('daftar-room/detailroom/hotel/{id}',[ManagementRoomController::class, 'detailroomhotel'])->name('partner.management.room.detailroomhotel');
        Route::get('daftar-room/detailroom/hostel/{id}',[ManagementRoomController::class, 'detailroomhostel'])->name('partner.management.room.detailroomhostel');

        Route::get('daftar-room/detailroom/hotel/showimage/{id}', [ManagementRoomController::class, 'showhotelroomImage'])->name('partner.management.room.showhotelroomimage');
        Route::post('daftar-room/detailroom/hotel/updateimage/{id}', [ManagementRoomController::class, 'updatehotelroomImage'])->name('partner.management.room.updatehotelroomImage');
        Route::delete('daftar-room/detailroom/hotel/destroyimage/{id}', [ManagementRoomController::class, 'destroyhotelroomimage'])->name('partner.management.hotel.destroyhotelroomimage');

        Route::get('daftar-room', [ManagementRoomController::class, 'index'])->name('partner.management.room');
        Route::get('daftar-room/detailroom/hotel/{id}',[ManagementRoomController::class, 'detailroomhotel'])->name('partner.management.room.detailroomhotel');
        Route::get('daftar-room/detailroom/hostel/{id}',[ManagementRoomController::class, 'detailroomhostel'])->name('partner.management.room.detailroomhostel');

        Route::get('daftar-room/detailroom/hotel/showimage/{id}', [ManagementRoomController::class, 'showhotelroomImage'])->name('partner.management.room.showhotelroomimage');
        Route::post('daftar-room/detailroom/hotel/updateimage/{id}', [ManagementRoomController::class, 'updatehotelroomImage'])->name('partner.management.room.updatehotelroomImage');
        Route::delete('daftar-room/detailroom/hotel/destroyimage/{id}', [ManagementRoomController::class, 'destroyhotelroomimage'])->name('partner.management.hotel.destroyhotelroomimage');

        Route::prefix('management-hotel')->group(function () {
            Route::get('', [ManagementHotelController::class, 'index'])->name('partner.management.hotel');
            Route::get('detail-hotel/{id}', [ManagementHotelController::class, 'detailHotel'])->name('partner.management.hotel.detail');
            Route::delete('detail-hotel/{id}/deleteimage', [ManagementHotelController::class, 'destroyimage'])->name('partner.management.hotel.destroyimage');

            // Route CRUD HotelRule
            Route::post('detail-hotel/', [ManagementHotelController::class, 'storeRule'])->name('partner.management.hotel.storerule');
            Route::get('detail-hotel/show/rules/{id}', [ManagementHotelController::class, 'showRule'])->name('partner.management.hotel.showrule');
            Route::put('detail-hotel/{hotelrule}', [ManagementHotelController::class, 'updaterule'])->name('partner.management.hotel.updaterule');
            Route::delete('detail-hotel/{id}/destroyrule', [ManagementHotelController::class, 'destroyRule'])->name('partner.management.hotel.destroyrule');

            Route::delete('detail-hotel/{id}/deleteroom', [ManagementHotelController::class, 'destroyRoom'])->name('partner.management.hotel.destroyroom');
            //            Route::get('detail-hotel/{hotel}', [ManagementHotelController::class, 'index'])->name('partner.management.hotel');

            Route::get('setting-hotel-information/{id}', [ManagementHotelController::class, 'settingHotel'])->name('partner.management.hotel.setting.hotel');
            Route::get('setting-hotel-photo/{id}', [ManagementHotelController::class, 'settingPhoto'])->name('partner.management.hotel.setting.photo');
            Route::get('setting-hotel-room/{id}', [ManagementHotelController::class, 'settingRoom'])->name('partner.management.hotel.setting.room');
            Route::get('setting-hotel-room/create/{id}', [ManagementHotelController::class, 'settingRoomCreate'])->name('partner.management.hotel.setting.room.create');
            Route::post('setting-hotel-room/post', [ManagementHotelController::class, 'settingRoomPost'])->name('partner.management.hotel.setting.room.post');
            Route::delete('setting-hotel-room/delete/{id}', [ManagementHotelController::class,'settingRoomDelete'])->name('partner.management.setting.room.delete');
            Route::get('setting-hotel-room/hotel-room/{hotel_id}/{id}', [ManagementHotelController::class,'settingRoomShow'])->name('partner.management.setting.room.show');
            Route::post('setting-hotel-room/hotel-room/update/{hotel_id}/{id}', [ManagementHotelController::class,'settingRoomUpdate'])->name('partner.management.setting.room.update');

            //            Route::get('detail-hotel/{hotel}', [ManagementHotelController::class, 'index'])->name('partner.management.hotel');


        });

        Route::prefix('management-hostel')->group(function () {
            Route::get('', [ManagementHostelController::class, 'index'])->name('partner.management.hostel');
            Route::get('detail-hostel/{id}', [ManagementHostelController::class, 'detailhostel'])->name('partner.management.hostel.detail');
            Route::delete('detail-hostel/{id}/deleteimage', [ManagementHostelController::class, 'destroyimage'])->name('partner.management.hostel.destroyimage');

            // Route CRUD hostelRule
            Route::post('detail-hostel/', [ManagementHostelController::class, 'storeRule'])->name('partner.management.hostel.storerule');
            Route::get('detail-hostel/show/rules/{id}', [ManagementHostelController::class, 'showRule'])->name('partner.management.hostel.showrule');
            Route::put('detail-hostel/{hostelrule}', [ManagementHostelController::class, 'updaterule'])->name('partner.management.hostel.updaterule');
            Route::delete('detail-hostel/{id}/destroyrule', [ManagementHostelController::class, 'destroyRule'])->name('partner.management.hostel.destroyrule');


            Route::delete('detail-hostel/{id}/deleteroom', [ManagementHostelController::class, 'destroyRoom'])->name('partner.management.hostel.destroyroom');
            //            Route::get('detail-hostel/{hostel}', [ManagementhostelController::class, 'index'])->name('partner.management.hostel');
            // Route::get('setting-hostel-information/{id}', [ManagementHostelController::class, 'settinghostel'])->name('partner.management.hostel.setting.hostel');
            // Route::get('setting-hostel-photo/{id}', [ManagementHostelController::class, 'settingPhoto'])->name('partner.management.hostel.setting.photo');
            // Route::get('setting-hostel-room/{id}', [ManagementHostelController::class, 'settingRoom'])->name('partner.management.hostel.setting.room');
            // Route::get('setting-hostel-room/create/{id}', [ManagementHostelController::class, 'settingRoomCreate'])->name('partner.management.hostel.setting.room.create');
            // Route::post('setting-hostel-room/post', [ManagementHostelController::class, 'settingRoomPost'])->name('partner.management.hostel.setting.room.post');
            // Route::delete('setting-hostel-room/delete/{id}', [ManagementHostelController::class,'settingRoomDelete'])->name('partner.management.setting.room.delete');
            // Route::get('setting-hostel-room/hostel-room/{hostel_id}/{id}', [ManagementHostelController::class,'settingRoomShow'])->name('partner.management.setting.room.show');
            // Route::post('setting-hostel-room/hostel-room/update/{hostel_id}/{id}', [ManagementHostelController::class,'settingRoomUpdate'])->name('partner.management.setting.room.update');


            //   Route::get('detail-hostel/{hotel}', [ManagementHotelController::class, 'index'])->name('partner.management.hotel');

        });
    });





});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
