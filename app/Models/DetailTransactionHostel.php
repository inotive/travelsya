<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransactionHostel extends Model
{
    public $timestamps = false;

    protected $table = 'detail_transaction_hostel';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
