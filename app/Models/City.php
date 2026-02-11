<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class City extends Model
{
    use HasFactory;


    protected $fillable = [
        'city_id',
        'city_name',
        'prov_id',
        'image',
        'status'
    ];

    /**
     * Get all of the recreations for the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recreations(): HasMany
    {
        return $this->hasMany(Recreation::class, 'city', 'city_id');
    }

    public function has_cars(): HasManyThrough
    {
        return $this->hasManyThrough(CarRentalHasCars::class, CarRental::class, 'city', 'car_rental_id', 'city_id', 'id');
    }
    
    /**
     * Get all of the car rentals for the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carRentals(): HasMany
    {
        return $this->hasMany(CarRental::class, 'city', 'city_id');
    }
    
    /**
     * Scope a query to only include cities that have car rentals
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasCarRentals($query)
    {
        return $query->whereHas('carRentals');
    }
}
