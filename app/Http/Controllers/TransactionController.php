<?php

namespace App\Http\Controllers;

use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    protected $travelsya;

    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function cart(Request $request)
    {
        // header("Location: https://checkout-staging.xendit.co/web/6441800f6f99867059c461d0");
        $product = $this->travelsya->pricelistId($request->pricelist);
        return view('cart', ['product' => $product['data'][0], 'no_hp' => $request->notelp, 'service' => $request->service]);
    }

    public function requestPpob(Request $request)
    {
        try {
            $data = $request->all();
            if (isset($data['point'])) {

                $fee = [
                    [
                        "type" => "admin",
                        "value" => 1000,
                    ],
                    [
                        "type" => "point",
                        "value" => 0 - $data['point'],
                    ]
                ];
            } else {
                $fee = [
                    [
                        "type" => "admin",
                        "value" => 1000,
                    ]
                ];
            }

            $ppob = $this->travelsya->requestPpob([
                "service" => $data['service'],
                "payment" => $data['payment_method'],
                "detail" => [
                    [
                        "product_id" => $data['id'],
                        "name" => $data['kode'],
                        "no_hp" => $request->notelp,
                        "price" => 0,
                        "qty" => 1,
                        "url" => ""

                    ]
                ],
                "fees" => $fee

            ]);
            if ($ppob['meta']['code'] != 200)
                return view('product.pulsa');

            return redirect()->to($ppob['data']['invoice_url'])->send();
        } catch (ValidationException $th) {
            return $th;
        }
    }

    public function reservation()
    {
        return view('reservation.index');
    }
    public function requestHostel(Request $request)
    {
        try {
            $data = $request->all();
            dd($request->all());
            $hostel = $this->travelsya->requestHostel([
                "service" => $data['service'],
                "payment" => $data['payment_method'],
                "hostel_room_id" => $data['hostel_room_id'],
                "point" => 0,
                "guest" => [[
                    "type_id" => "KTP",
                    "identity" => 123456,
                    "name" => "budi"
                ]],
                "start" => "2023-08-13", //"2023-08-13"
                "end" => "2023-08-13",
                "url" => "linkproduct"

            ]);
            if ($hostel['meta']['code'] != 200)
                return view('product.pulsa');

            return redirect()->to($hostel['data']['invoice_url'])->send();
        } catch (ValidationException $th) {
            return $th;
        }
    }
}
