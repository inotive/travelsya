<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusTravelHasFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_travel_has_bus_id',
        'bus_facility_id',
    ];

    public function busTravel()
    {
        return $this->belongsTo(BusTravelHasBus::class, 'bus_travel_has_bus_id', 'id');
    }

    public function facility()
    {
        return $this->belongsTo(BusFacility::class, 'bus_facility_id', 'id');
    }
}
