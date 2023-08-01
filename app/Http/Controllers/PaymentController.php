<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Xendit\Invoice;
use Xendit\Xendit;
class PaymentController extends Controller
{
    public function __construct()
    {
        Xendit::setApiKey('xnd_development_720yPHpZAyEfNzCycBS6I6nnREM6JrieSYS4zdytWdptFMn68JEyEsoBvPYs');
    }

    public function store()
    {
        $param = [
            'external_id' => 'INV-20230622-HOSTEL-0000011',
            'items' => [
                [
                    "product_id" => 2,
                    "name" => "Hotel 5",
                    "price" => 51231,
                    "quantity" => 3,
                ]
            ],
            'amount' => 51231,
            'success_redirect_url'  => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => 'Bagus',
                'email' => 'gustibagus34@gmail.com',
                'mobile_number' => '+6281253290605'
            ],
            'fees' => [
                'type' => 'ADMIN',
                'value' => 5000
            ]
        ];

        $invoiceNumber = Invoice::create($param);

        return $invoiceNumber;
    }
}
