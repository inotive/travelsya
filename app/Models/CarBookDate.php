<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarBookDate extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'car_rental_has_car_id',
        'start',
        'end',
    ];

    /**
     * Get the transaction that owns the CarBookDate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(CarRentalHasCars::class, 'car_rental_has_car_id', 'id');
    }
}
