<?php

namespace App\Http\Controllers;

use App\Models\DetailTransactionHotel;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionPPOB;
use App\Models\Help;
use App\Models\HistoryPoint;
use App\Models\HostelRating;
use App\Models\HotelRating;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        $data['point'] = auth()->user()->point;

        //dd(Auth::user()->image);

        return view('user.profile', $data);
    }

    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        $password = $user->password;

        if ($request->new_password != '') {
            $password = bcrypt($request->new_password);
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('public/users');
            // $image->storeAs('users', $image->hashName());
            $fileName = basename($image);

            Storage::delete('users/'.$user->image);

            $user->update([
                'image' => $fileName,
                'name' => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => $password,
            ]);

        } else {
            $user->update([
                'name' => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => $password,
            ]);
        }



        return redirect()->back();
    }

    public function photoProfile(){
        $user = Auth::user();
        $image = $user->image;

        return response()->json([
            'data' => $image
        ]);
    }

    public function orderHistory()
    {
        $transactions = Transaction::where('transactions.user_id', auth()->id())
            ->leftJoin('detail_transaction_top_up as dtt', 'dtt.transaction_id', '=', 'transactions.id')
            ->leftJoin('detail_transaction_ppob as dtp', 'dtp.transaction_id', '=', 'transactions.id')
            ->leftJoin('detail_transaction_hotel as dth', 'dth.transaction_id', '=', 'transactions.id')
            ->leftJoin('detail_transaction_hostel as dths', 'dths.transaction_id', '=', 'transactions.id')
            ->leftJoin('products as p_dtt', 'p_dtt.id', '=', 'dtt.product_id')
            ->leftJoin('products as p_dtp', 'p_dtp.id', '=', 'dtp.product_id')
            ->leftJoin('hotels', 'hotels.id', '=', 'dth.hotel_id')
            ->leftJoin('hostels', 'hostels.id', '=', 'dths.hostel_id')
            ->select(
                'transactions.id',
                'transactions.no_inv',
                'transactions.service',
                'transactions.service_id',
                'transactions.user_id',
                'transactions.status',
                'transactions.total',
                'transactions.created_at',
                'dtt.product_id as product_id_topup',
                'dtp.product_id as product_id_ppob',
                'p_dtt.name as name_topup',
                'p_dtp.name as name_ppob',
                'hotels.name as name_hotel',
                'hostels.name as name_hostel',
            );

        $data['all_transactions'] = $transactions->orderBy('transactions.created_at', 'desc')->get();

        $pending_transactions = clone $transactions;
        $data['pending_transactions'] = $pending_transactions->where('transactions.status', 'PENDING')
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        $history_transactions = clone $transactions;
        $data['history_transactions'] = $history_transactions
            ->where('transactions.status', '!=', 'PENDING')
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        return view('user.orderhistory', $data);
    }

    public function orderDetailHotel($id)

    {
        // $transactionHotel = DB::table('detail_transaction_hotel')
        //     ->join('transactions', 'detail_transaction_hotel.transaction_id', '=', 'transactions.id')
        //     ->join('hotels', 'detail_transaction_hotel.hotel_id', '=', 'hotels.id')
        //     ->join('hotel_rooms', 'detail_transaction_hotel.hotel_room_id', '=', 'hotel_rooms.id')
        //     ->join('guests', 'guests.transaction_id', '=', 'transactions.id')
        //     ->join('users', 'transactions.user_id', '=', 'users.id')
        //     ->join('hotel_images', 'hotel_images.hotel_id', '=', 'hotels.id')
        //     ->leftJoin('history_points', 'transactions.id', '=', 'history_points.transaction_id')
        //     ->select(
        //         'detail_transaction_hotel.*',
        //         'hotels.id as hotel_id',
        //         'hotels.address as hotel_address',
        //         'guests.name as guest_name',
        //         //'guests.nomor_telepon as guest_telp',
        //         'transactions.no_inv as inv_num',
        //         'transactions.created_at as created_transaction',
        //         'transactions.payment_method as payment_method',
        //         'transactions.status as status_pembayaran',
        //         'users.email as user_email',
        //         'hotels.name as hotel_name',
        //         'hotel_rooms.name as hotelRoomName',
        //         'hotel_rooms.sellingprice as sellingPrice',
        //         'hotel_rooms.id as hotel_room_id',
        //         'hotel_rooms.roomsize as room_size',
        //         DB::raw('(CASE WHEN hotel_images.main THEN hotel_images.image ELSE NULL END) as `gambar-hotel`')
        //     )
        //     ->where('detail_transaction_hotel.transaction_id', $id)
        //     ->first();
        $transactionHotel = DetailTransactionHotel::with('transaction.guest', 'hotel.hotelImage', 'hotel.hotelRating', 'hotelRoom', 'transaction')
            ->whereHas('transaction', function ($q) use ($id){
                $q->where('no_inv' , $id);
            })->first();

        $hotelPict = DB::table('hotel_images')
            ->where('hotel_id', $transactionHotel->hotel_id)
            ->first();

        $roomPict = DB::table('hotel_room_images')
            ->where('hotel_id', $transactionHotel->hotel_id)
            ->first();
        //dd($transactionHotel);

        $roomFacilities = DB::table('hotel_room_facilities')
            ->join('facilities', 'hotel_room_facilities.facility_id', '=', 'facilities.id')
            ->select('hotel_room_facilities.*', 'facilities.name as facility_name')
            ->where('hotel_room_id', $transactionHotel->hotel_room_id)
            ->get();

        //dd($roomFacilities);


        return view('user.order-detail.hotel', compact('transactionHotel', 'hotelPict', 'roomPict', 'roomFacilities'));
    }
    public function orderDetailHostel($id)

    {

        $transactionHostel = DetailTransactionHostel::with('transaction.guest', 'hostel.hostelImage', 'hostel.hostelRating', 'hostelRoom', 'transaction')
            ->whereHas('transaction', function ($q) use ($id) {
                $q->where('no_inv', $id);
            })->first();

        $hostelPict = DB::table('hostel_images')
            ->where('hostel_id', $transactionHostel->hostel_id)
            ->first();

        $roomPict = DB::table('hostel_room_images')
            ->where('hostel_room_id', $transactionHostel->hostel_room_id)
            ->first();
        //dd($transactionHostel);

        $roomFacilities = DB::table('hostel_room_facilities')
            ->join('facilities', 'hostel_room_facilities.facility_id', '=', 'facilities.id')
            ->select('hostel_room_facilities.*', 'facilities.name as facility_name')
            ->where('hostel_room_id', $transactionHostel->hostel_room_id)
            ->get();

        //dd($roomFacilities);


        return view('user.order-detail.hostel', compact('transactionHostel', 'hostelPict', 'roomPict', 'roomFacilities'));
    }

    public function orderDetailListrikVoucher($id)
    {

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
                'transactions.total',
                'history_points.point as points',
                'users.name as user_name',
                DB::raw('(CASE WHEN history_points.flow = "credit" THEN history_points.point ELSE 0 END) as point_pengeluaran'),
                DB::raw('detail_transaction_top_up.total_tagihan +
            detail_transaction_top_up.fee_travelsya -
            (CASE WHEN history_points.flow = "credit" THEN history_points.point ELSE 0 END) as total_after_fee')
            )
            ->where('transactions.no_inv', $id)
            ->first();
        // dd($transactionPPOB);
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
        //dd($transactionPPOB);


        // $transaction = DetailTransactionPPOB::where('id', 2)->first();
        return view('user.order-detail.listrik-voucher', compact('transactionPPOB', 'pemasukan', 'pengeluaran'));
    }

    public function orderDetailListrik($id)
    {
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
                'transactions.total',
                'users.name as user_name',
                DB::raw('(CASE WHEN history_points.flow = "credit" THEN history_points.point ELSE 0 END) as point_pengeluaran'),
                DB::raw('detail_transaction_ppob.total_tagihan +
            detail_transaction_ppob.fee_travelsya -
            (CASE WHEN history_points.flow = "credit" THEN history_points.point ELSE 0 END) as total_after_fee')
            )
            ->where('transactions.no_inv', $id)
            ->first();

        // dd($transactionPPOB->transaction_id);

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

//        dd($transactionPPOB->inv_num);
//
        return view('user.order-detail.listrik', compact('transactionPPOB', 'pemasukan', 'pengeluaran'));
    }

    public function help()
    {
        $data['helps'] = Help::orderBy('title')->get();

        return view('user.help', $data);
    }

    public function bantuan()
    {
        $data['helps'] = Help::orderBy('title')->get();

        return view('user.bantuan', $data);
    }

    public function point()
    {
        $user_id = auth()->user()->id;

        $historyPoints = HistoryPoint::with('user', 'transaction')->where('user_id', $user_id)->get();
        return view('user.point', compact('historyPoints'));
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

    public function createRatingDetailHotel(Request $request, HotelRating $hotelRating)
    {
        $user_id = auth()->user()->id;

        $hotelRating->create([
            'transaction_id' => $request->transaction_id,
            'users_id'        => $user_id,
            'hotel_id'       => $request->hotel_id,
            'hotel_room_id' => $request->hotel_rooms_id,
            'rate'           => $request->rating,
            'comment'        => $request->comment
        ]);
        toast('Hotel Rating Sudah Di Buat', 'success');
        return redirect()->back();
    }

    public function createRatingDetailHostel(Request $request, HostelRating $hostelRating)
    {
        $user_id = auth()->user()->id;

        $hostelRating->create([
            'users_id'        => $user_id,
            'transaction_id' => $request->transaction_id,
            'hostel_id'       => $request->hostel_id,
            'hostel_room_id' => $request->hostel_rooms_id,
            'rate'           => $request->rating,
            'comment'        => $request->comment
        ]);
        toast('Hotel Rating Sudah Di Buat', 'success');
        return redirect()->back();
    }
}
