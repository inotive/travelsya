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

    public function scopeActive(){
        return $this->where('is_active', 1);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(BusTravelRating::class, 'bus_travel_id', 'id')->orderBy('created_at', 'desc');
    }

    public function avgRating()
    {
        $rating = BusTravelRating::where('bus_travel_id', $this->id)->get()->pluck('rate')->toArray();

        $data = count($rating);

        if($data > 0){
            $avg = array_sum($rating) / $data;

            return round($avg, 1);
        }else{
            return 0;
        }
    }
}
