<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransactionBus extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'bus_travel_id',
        'bus_travel_has_bus_id',
        'bus_departure_id',
        'booking_id',
        'departure_time',
        'from',
        'to',
        'price',
        'fee_admin',
        'duration',
        'kode_unik',
        'created_at',
        'updated_at',
        'customer_name',
        'customer_email',
        'customer_phone',
    ];

    /**
     * Get the transaction that owns the DetailTransactionBus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function busTravel(): BelongsTo
    {
        return $this->belongsTo(BusTravels::class, 'bus_travel_id', 'id');
    }
    public function departure(): BelongsTo
    {
        return $this->belongsTo(BusDeparture::class, 'bus_departure_id', 'id');
    }
    public function busTravelHasBus(): BelongsTo
    {
        return $this->belongsTo(BusTravelHasBus::class, 'bus_travel_has_bus_id', 'id');
    }
}
