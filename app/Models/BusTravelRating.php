<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusTravelRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'bus_travel_id',
        'bus_travel_has_bus_id',
        'user_id',
        'rate',
        'comment',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
    public function busTravel(): BelongsTo
    {
        return $this->belongsTo(BusTravels::class, 'bus_travel_id', 'id');
    }
    public function busTravelBus(): BelongsTo
    {
        return $this->belongsTo(BusTravelHasBus::class, 'bus_travel_has_bus_id', 'id');
    }
}
