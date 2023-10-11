<?php

namespace App\Http\Controllers;

use App\Models\DetailTransactionPPOB;
use App\Models\Help;
use App\Models\Transaction;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $travelsya;

    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function transaction()
    {
        if (!session()->get('user'))
            return redirect()->route('login');

        $transaction = $this->travelsya->listTransaction();
        $transactionData = $transaction['data'];
        if ($transaction['meta']['code'] != 200) {
            $transactionData = 'not found';
        }

        return view('user.transaction', ['transactions' => $transactionData]);
    }
    public function profile()
    {
//        if (empty(Auth::check()))
//            return redirect()->route('login');
//
//        $transaction = $this->travelsya->listTransaction();
//        $transactionData = $transaction['data'];
//        if ($transaction['meta']['code'] != 200) {
//            $transactionData = 'not found';
//        }
        $transactionData = DB::table('transactions')->get();
        return view('user.profile', ['transactions' => $transactionData]);
    }

    public function orderHistory() {
        return view('user.orderhistory');
    }

    public function orderDetailHotel(){
        $transactionHotel = DB::table('detail_transaction_hotel')
        ->join('transactions', 'detail_transaction_hotel.transaction_id', '=', 'transactions.id')
        ->join('hotels', 'detail_transaction_hotel.hotel_id', '=', 'hotels.id')
        ->join('hotel_rooms', 'detail_transaction_hotel.hotel_room_id', '=', 'hotel_rooms.id')
        ->join('guests', 'guests.transaction_id', '=', 'transactions.id')
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->join('hotel_images', 'hotel_images.hotel_id', '=', 'hotels.id')
        ->leftJoin('history_points', 'transactions.id', '=', 'history_points.transaction_id')
        ->select('detail_transaction_hotel.*',
                'hotels.id as hotel_id',
                'hotels.address as hotel_address',
                'guests.name as guest_name',
                //'guests.nomor_telepon as guest_telp',
                'transactions.no_inv as inv_num',
                'transactions.created_at as created_transaction',
                'transactions.payment_method as payment_method',
                'transactions.status as status_pembayaran',
                'users.email as user_email',
                'hotels.name as hotel_name',
                'hotel_rooms.name as hotelRoomName',
                'hotel_rooms.sellingprice as sellingPrice',
                'hotel_rooms.id as hotel_room_id',
                'hotel_rooms.roomsize as room_size',
                DB::raw('(CASE WHEN hotel_images.main THEN hotel_images.image ELSE NULL END) as `gambar-hotel`')
                )
        ->where('detail_transaction_hotel.id', 1)
        ->first();

        $hotelPict = DB::table('hotel_images')
        ->where('main', 1)
        ->where('hotel_id', $transactionHotel->hotel_id)
        ->first();

        $roomPict = DB::table('hotel_room_images')
        ->where('hotel_id', $transactionHotel->hotel_id)
        ->where('hotel_room_id', $transactionHotel->hotel_room_id)
        ->first();

        $roomFacilities = DB::table('hotel_room_facilities')
        ->join('facilities', 'hotel_room_facilities.facility_id', '=', 'facilities.id')
        ->select('hotel_room_facilities.*', 'facilities.name as facility_name')
        ->where('hotel_id', $transactionHotel->hotel_id)
        ->where('hotel_room_id', $transactionHotel->hotel_room_id)
        ->get();

        //dd($roomFacilities);

        return view('user.order-detail.hotel', compact('transactionHotel', 'hotelPict', 'roomPict', 'roomFacilities'));
    }

    public function orderDetailListrikVoucher(){

    $transactionPPOB = DB::table('detail_transaction_top_up')
    ->join('products', 'detail_transaction_top_up.product_id', '=', 'products.id')
    ->join('transactions', 'detail_transaction_top_up.transaction_id', '=', 'transactions.id')
    ->join('users', 'transactions.user_id', '=', 'users.id')
    ->leftJoin('history_points', 'transactions.id', '=', 'history_points.transaction_id')
    // ->join('history_points', 'detail_transaction_top_up.history_point_id', '=', 'history_points.id')
    ->select(
        'detail_transaction_top_up.*',
        'products.name as product_name',
        'products.category as product_category',
        'transactions.no_inv as inv_num',
        'transactions.service as service',
        'transactions.created_at as created_transaction',
        'transactions.payment_method as payment_method',
        'transactions.status as status',
        'history_points.point as points',
        'users.name as user_name',
        DB::raw('(CASE WHEN history_points.flow = "credit" THEN history_points.point ELSE 0 END) as point_pengeluaran'),
        DB::raw('detail_transaction_top_up.total_tagihan +
            detail_transaction_top_up.fee_travelsya -
            (CASE WHEN history_points.flow = "credit" THEN history_points.point ELSE 0 END) as total_after_fee')
    )
    ->where('detail_transaction_top_up.id', 1)
    ->first();

    $pemasukan = DB::table('history_points')
    ->select('transaction_id', 'point as jumlah_point')
    ->where('flow', 'debit')
    ->where('transaction_id', $transactionPPOB->transaction_id)
    ->first();

    $pengeluaran = DB::table('history_points')
    ->select('transaction_id', 'point as jumlah_point')
    ->where('flow', 'credit')
    ->where('transaction_id', $transactionPPOB->transaction_id)
    ->first();


    // $transaction = DetailTransactionPPOB::where('id', 2)->first();
        return view('user.order-detail.listrik-voucher', compact('transactionPPOB', 'pemasukan', 'pengeluaran'));
    }

    public function orderDetailListrik(){

    $transactionPPOB = DB::table('detail_transaction_ppob')
    ->join('products', 'detail_transaction_ppob.product_id', '=', 'products.id')
    ->join('transactions', 'detail_transaction_ppob.transaction_id', '=', 'transactions.id')
    ->join('users', 'transactions.user_id', '=', 'users.id')
    ->leftJoin('history_points', 'transactions.id', '=', 'history_points.transaction_id')
    // ->join('history_points', 'detail_transaction_ppob.history_point_id', '=', 'history_points.id')
    ->select(
        'detail_transaction_ppob.*',
        'products.name as product_name',
        'transactions.no_inv as inv_num',
        'transactions.service as service',
        'transactions.created_at as created_transaction',
        'transactions.payment_method as payment_method',
        'transactions.status as status',
        'history_points.point as points',
        'users.name as user_name',
        DB::raw('(CASE WHEN history_points.flow = "credit" THEN history_points.point ELSE 0 END) as point_pengeluaran'),
        DB::raw('detail_transaction_ppob.total_tagihan +
            detail_transaction_ppob.fee_travelsya -
            (CASE WHEN history_points.flow = "credit" THEN history_points.point ELSE 0 END) as total_after_fee')
    )
    ->where('detail_transaction_ppob.id', 1)
    ->first();

    $pemasukan = DB::table('history_points')
    ->select('transaction_id', 'point as jumlah_point')
    ->where('flow', 'debit')
    ->where('transaction_id', $transactionPPOB->transaction_id)
    ->first();

    $pengeluaran = DB::table('history_points')
    ->select('transaction_id', 'point as jumlah_point')
    ->where('flow', 'credit')
    ->where('transaction_id', $transactionPPOB->transaction_id)
    ->first();

        return view('user.order-detail.listrik', compact('transactionPPOB', 'pemasukan', 'pengeluaran'));
    }

    public function help()
    {
        $helps = Help::all();

        return view('user.help', compact('helps'));
    }

    public function detailTransaction($no_inv)
    {
        if (!session()->get('user'))
            return redirect()->route('login.view');

        $detailTransaction = $this->travelsya->detailTransaction($no_inv);
        if ($detailTransaction['meta']['code'] != 200) {
            return redirect()->back();
        }

        return view('user.detailtransaction', ['transaction' => $detailTransaction['data'][0]]);
    }
}
