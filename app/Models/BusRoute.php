<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusRoute extends Model
{
    use HasFactory;

    protected $fillabel = [
        'name'
    ];

    /**
     * Get all of the departure for the BusRoute
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departure_from(): HasMany
    {
        return $this->hasMany(BusDeparture::class, 'from_route_id', 'id');
    }

    public function departure_to(): HasMany
    {
        return $this->hasMany(BusDeparture::class, 'to_route_id', 'id');
    }
}
