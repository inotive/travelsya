<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarRentalRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'car_rental_id',
        'car_rental_has_car_id',
        'user_id',
        'rate',
        'comment',
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
