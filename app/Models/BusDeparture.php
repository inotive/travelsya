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
        "departure_date",
        "from_city_id",
        "to_city_id",
        "titik_naik",
        "titik_turun",
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
        return $this->belongsTo(City::class, 'from_city_id', 'id');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(City::class, 'to_city_id', 'id');
    }
}
