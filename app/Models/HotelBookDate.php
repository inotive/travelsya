<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBookDate extends Model
{
    use HasFactory;
    protected $guarded = [];



    /**
     * Get the transaction that owns the BookDate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function hotelRoom()
    {
        return $this->belongsTo(HotelRoom::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
