<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransactionPPOB extends Model
{
    public $timestamps = false;
    protected $table = 'detail_transaction_ppob';


    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
