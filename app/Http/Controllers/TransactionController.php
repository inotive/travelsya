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
        $ppob = '';
        header("Location: https://checkout-staging.xendit.co/web/6441800f6f99867059c461d0");
        $product = $this->travelsya->pricelistId($request->id);
        return view('cart', ['product' => $product['data'][0], 'no_hp' => $request->notelp]);
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
                "service" => 'ppob',
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
}
