<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransactionHostel extends Model
{
    public $timestamps = false;
    protected $table = 'detail_transaction_hostel';

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class);
    }


    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
