<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusTravelHasBus extends Model
{
    use HasFactory;

    protected $fillable = [
        "bus_travel_id",
        "name",
        "number_seats",
        "class",
        "is_active",
        "image"
    ];

    /**
     * Get the busTravel that owns the BusTravelHasBus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function busTravel(): BelongsTo
    {
        return $this->belongsTo(BusTravels::class, 'bus_travel_id', 'id');
    }

    /**
     * Get all of the departure for the BusTravelHasBus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departure(): HasMany
    {
        return $this->hasMany(BusDeparture::class, 'bus_travel_has_bus_id', 'id');
    }

    public function booked(): HasMany
    {
        return $this->hasMany(BusBooked::class, 'bus_travel_has_bus_id', 'id');
    }
}
