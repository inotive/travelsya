<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransactionTopUp extends Model
{
    public $timestamps = false;
    protected $table = 'detail_transaction_top_up';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
