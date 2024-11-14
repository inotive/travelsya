<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusTravels extends Model
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
     * Get all of the hasBus for the BusTravels
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasBus(): HasMany
    {
        return $this->hasMany(BusTravelHasBus::class, 'bus_travel_id', 'id');
    }

    public function booked(): HasMany
    {
        return $this->hasMany(BusBooked::class, 'bus_travel_id', 'id');
    }
}
