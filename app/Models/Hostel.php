<?php

namespace App\Models;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
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
     * Get the hostelRoom that owns the Hostel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hostelRoom()
    {
        return $this->hasMany(HostelRoom::class);
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

    public function hostelImage()
    {
        return $this->hasMany(HostelImage::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
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


    public function hostelFacilities()
    {
        return $this->hasMany(HostelRoomFacility::class);
    }

    public function hostelRule()
    {
        return $this->hasMany(HostelRule::class);
    }
}
