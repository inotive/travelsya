<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusDeparture extends Model
{
    use HasFactory;

    protected $fillable = [
        "bus_travel_has_bus_id",
        "departure_time",
        "from_route_id",
        "to_route_id",
        "duration",
        "days",
        "price",
    ];

    public function busTravel(): BelongsTo
    {
        return $this->belongsTo(BusTravelHasBus::class, 'bus_travel_has_bus_id', 'id');
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(BusRoute::class, 'from_route_id', 'id');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(BusRoute::class, 'to_route_id', 'id');
    }
}
