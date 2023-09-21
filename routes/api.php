<?php

use App\Http\Controllers\API\AdController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CallbackController;
use App\Http\Controllers\API\HostelController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\PpobController;
use App\Http\Controllers\API\PulsaDataController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\TransactionController;
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

// PULSA & DATA
route::get('/pulsa', [PulsaDataController::class, 'getPulsa']);
route::get('/data', [PulsaDataController::class, 'getData']);

//ads
route::get('/ads', [AdController::class, 'index']);
route::get('/ads/{id}', [AdController::class, 'show']);

route::post('/ppob/inquiry/request', [PpobController::class, 'requestInquiry']);
// route::post('/hotel/transaction/request', [HotelController::class, 'requestTransaction']);


Route::middleware('auth:sanctum')->group(function () {

    // ppob product
    route::get('/ppob', [PpobController::class, 'getServices']);
    route::get('/ppob/{id}', [PpobController::class, 'getService']);
    route::post('/ppob/transaction', [PpobController::class, 'transaction']);
    route::post('/ppob/status', [PpobController::class, 'status']);
    route::post('/ppob/transaction/request', [PpobController::class, 'requestTransaction']);
    // route::post('/ppob/inquiry/request', [PpobController::class, 'requestInquiry']);

    //auth
    route::post('/logout', [AuthController::class, 'logout']);
    route::post('/user/update', [AuthController::class, 'update']);
    route::post('/user', [AuthController::class, 'profile']);


    //transaction
    // route::get('/transaction',[TransactionController::class,'GetServices']);
    route::post('/transaction/user', [TransactionController::class, 'getTransactionUser']);
    route::post('/transaction/invoice', [TransactionController::class, 'getTransactionInv']);

    route::post('/hostel/transaction/request', [HostelController::class, 'requestTransaction']);
    route::post('/hotel/transaction/request', [HotelController::class, 'requestTransaction']);


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

//setting
route::get('/saldo', [SettingController::class, 'getSaldo']);
route::get('/service', [SettingController::class, 'getService']);


//webhook
route::post('/callback/xendit', [CallbackController::class, 'xendit']);
