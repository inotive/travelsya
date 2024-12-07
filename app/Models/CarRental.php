<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'user_id',
        'is_active',
        'city',
        'phone',
        'address',
    ];

    /**
     * Get the kota that owns the CarRental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kota(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city', 'city_id');
    }

    public function hasCars(): HasMany
    {
        return $this->hasMany(CarRentalHasCars::class, 'car_rental_id', 'id');
    }
}
