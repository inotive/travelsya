<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransactionHotel extends Model
{
    public $timestamps = false;
    protected $table = 'detail_transaction_hotel';
    protected $fillable = ['transaction_id', 'hotel_id', 'hotel_room_id', 'booking_id', 'reservation_start', 'reservation_end', 'guest', 'room', 'rent_price', 'fee_admin'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
