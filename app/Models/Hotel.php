<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getFacilitiesAttribute($value)
    {
        $arrays = explode(',', $value);
        $fac = [];
        foreach ($arrays as $array) {
            if ($array == "TV")
                array_push($fac, ['icon' => 'fa fa-tv', 'name' => "TV"]);

            if ($array == "Breakfast")
                array_push($fac, ['icon' => 'fa fa-coffee', 'name' => "Breakfast"]);

            if ($array == "Wifi")
                array_push($fac, ['icon' => 'fa fa-wifi', 'name' => "Wifi"]);
        }
        return $fac;
    }

    /**
     * Get the hotelRoom that owns the Hostel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hotelRoom()
    {
        return $this->hasMany(HotelRoom::class);
    }

    /**
     * Get the user that owns the Hostel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotelImage()
    {
        return $this->hasMany(HotelImage::class);
    }

    public function hotelRating()
    {
        return $this->hasMany(HotelRating::class);
    }

    /**
     * Get the service that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
