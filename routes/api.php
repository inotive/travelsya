<?php

use App\Http\Controllers\API\AdController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CallbackController;
use App\Http\Controllers\API\CarRentalController;
use App\Http\Controllers\API\HealthBeautyController;
use App\Http\Controllers\API\HostelController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\PpobController;
use App\Http\Controllers\API\RatingHostelController;
use App\Http\Controllers\API\RatingHotelController;
use App\Http\Controllers\API\TopUpController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\RecreationController;
use App\Models\Recreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/unauthorized', function () {
    return json_encode(['message' => 'Unauthorized']);
})->name('unauthorized');

//auth
route::post('/register', [AuthController::class, 'register']);
route::post('/login', [AuthController::class, 'login']);
route::get('/xendit/succes', [TransactionController::class, 'redirectXenditSucces'])->name('redirect.succes');
route::get('/xendit/fail', [TransactionController::class, 'redirectXenditfail'])->name('redirect.fail');
route::post('/send-token-password', [AuthController::class, 'sendTokenPassword']);
route::post('/token-password-confirmation', [AuthController::class, 'tokenCheck']);
route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('payment', [\App\Http\Controllers\PaymentController::class, 'store']);
Route::post('/xendit/callback', [TransactionController::class, 'xenditCallback'])->name('xendit-callback');
Route::get('/fee-admin', [TransactionController::class, 'AdminFee']);

//hostel
route::post('/hostel', [HostelController::class, 'index']);
route::get('/hostel/city', [HostelController::class, 'hostelCity']);
route::get('/hostel/populer', [HostelController::class, 'hostelPopuler']);
route::get('/hostel/{id}', [HostelController::class, 'show']);
route::get('/hostel/room/{id}', [HostelController::class, 'room']);


//hotel
route::post('/hotel', [HotelController::class, 'index']);
route::get('/hotel/city', [HotelController::class, 'hotelCity']);
route::get('/hotel/populer', [HotelController::class, 'hotelPopuler']);
route::get('/hotel/{id}', [HotelController::class, 'show']);
route::get('/hotel/room/{id}', [HotelController::class, 'room']);

// Recreation
route::get('/recreation', [RecreationController::class, 'list2']);
route::get('/recreation_by_category/{id}', [RecreationController::class, 'recreation_by_category']);
route::get('/recreation_detail/{id}', [RecreationController::class, 'detail_recreations']);
route::get('/recreation_search', [RecreationController::class, 'search']);

// Health Beauty
route::get('/health_beauty', [HealthBeautyController::class, 'list']);
route::get('/health_home', [HealthBeautyController::class, 'healthHome']);
route::get('/health_search', [HealthBeautyController::class, 'search']);

route::get('/beauty_home', [HealthBeautyController::class, 'beautyHome']);
route::get('/beauty_search', [HealthBeautyController::class, 'beauty_search']);

route::get('/clinic_detail/{id}', [HealthBeautyController::class, 'detail']);

// Car Rental
// route::get('/find_car', [CarRentalController::class, 'search']);
route::post('/find_car', [CarRentalController::class, 'cari']);
route::get('/detail_car/{id}', [CarRentalController::class, 'detail_car']);

// PULSA & DATA
route::get('/pulsa', [TopUpController::class, 'getPulsa']);
route::post('/pulsa/topup/test', [TopUpController::class, 'testTopUP']);
route::get('/data', [TopUpController::class, 'getData']);

// E-wallet
route::get('/e-wallet', [TopUpController::class, 'getEWallet']);
route::get('/e-wallet/detail', [TopUpController::class, 'detailEwallet']);

//ads
route::get('/ads', [AdController::class, 'index']);
route::get('/ads/{id}', [AdController::class, 'show']);

route::post('/ppob/inquiry/request', [PpobController::class, 'requestInquiry']);


// ppob product
route::get('/ppob', [PpobController::class, 'getServices']);
route::get('/ppob/{id}', [PpobController::class, 'getService']);
route::post('/ppob/transaction', [PpobController::class, 'transaction']);
route::post('/ppob/status', [PpobController::class, 'status']);

Route::get('tax', [PpobController::class, 'productTax']);
// route::post('/ppob/inquiry/request', [PpobController::class, 'requestInquiry']);

//setting
route::get('/saldo', [SettingController::class, 'getSaldo']);
route::get('/service', [SettingController::class, 'getService']);

//webhook
route::post('/callback/xendit', [CallbackController::class, 'xendit']);
route::post('/callback/ppob/test', [CallbackController::class, 'callBackPPOB']);
route::post('/callback/ppob/test-voucher', [CallbackController::class, 'testCheckVoucher']);

// carrental
Route::get('/car-rentals', [CarRentalController::class, 'index']);

// recreation old
Route::get('/recreations', [RecreationController::class, 'index']);
Route::get('/recreations/{id}', [RecreationController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    //auth
    route::post('/logout', [AuthController::class, 'logout']);
    route::post('/user/update', [AuthController::class, 'update']);
    route::post('/user/update-photo', [AuthController::class, 'updatePhoto']);
    route::post('/user', [AuthController::class, 'profile']);
    route::get('user/total-point-available', [AuthController::class, 'totalPointsAvailable']);

    //transaction
    // route::get('/transaction',[TransactionController::class,'GetServices']);
    // route::post('/transaction/user', [TransactionController::class, 'getTransactionUser']);
    // route::post('/transaction/invoice', [TransactionController::class, 'getTransactionInv']);

    route::get('/transaction/user', [TransactionController::class, 'getTransactionUser']);
    route::get('/transaction/invoice', [TransactionController::class, 'getTransactionInv']);

    // route::post('/hotel/transaction/request', [HotelController::class, 'requestTransaction']);
    // Pembayaran
    route::post('/hotel/transaction/request', [HotelController::class, 'requestTransaction']);
    route::post('/hostel/transaction/request', [HostelController::class, 'requestTransaction']);
    route::post('/ppob/transaction/request', [PpobController::class, 'requestTransaction']);
    route::post('/pulsa/topup', [TopUpController::class, 'pembayaranPulsa']); // topup token/ewallet/pulsa

    route::post('/hotel/rating', [RatingHotelController::class, 'submit']);
    route::post('/hostel/rating', [RatingHostelController::class, 'submit']);

    // recreation order
    route::post('recreation/transaction/request', [RecreationController::class, 'requestTransaction']);
    route::post('recreation/rating', [RecreationController::class, 'postRating']);

    // clinic order
    route::post('clinic/transaction/request', [HealthBeautyController::class, 'requestTransaction']);
    route::post('clinic/rating', [HealthBeautyController::class, 'postRating']);

    // rent car order
    route::post('car_rent/transaction/request', [CarRentalController::class, 'requestTransaction']);
    route::post('car_rent/rating', [CarRentalController::class, 'postRating']);

    route::middleware('admin')->group(function () {
        route::post('/ads/store', [AdController::class, 'store']);
        route::post('/ads/update', [AdController::class, 'update']);
        route::post('/ads/{id}/destroy', [AdController::class, 'destroy']);

        route::post('/hostel/store', [HostelController::class, 'store']);
        route::post('/hostel/room/store', [HostelController::class, 'storeRoom']);
        route::post('/hostel/image/store', [HostelController::class, 'storeImage']);
        route::post('/hostel/{id}/update', [HostelController::class, 'update']);
        route::post('/hostel/{id}/destroy', [HostelController::class, 'destroy']);
    });
});
