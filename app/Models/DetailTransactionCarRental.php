<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransactionCarRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'car_rental_id',
        'car_rental_has_car_id',
        'booking_id',
        'start',
        'end',
        'location',
        'rent_price',
        'fee_admin',
        'duration',
        'kode_unik',
        'created_at',
        'updated_at',
        'customer_name',
        'customer_email',
        'customer_phone',
        'status'
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
    public function carRental(): BelongsTo
    {
        return $this->belongsTo(CarRental::class, 'car_rental_id', 'id');
    }
    public function car(): BelongsTo
    {
        return $this->belongsTo(CarRentalHasCars::class, 'car_rental_has_car_id', 'id');
    }
}
