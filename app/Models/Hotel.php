<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $guarded = [];

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
