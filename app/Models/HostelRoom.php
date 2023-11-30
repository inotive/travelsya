<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
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

    public function getImage1Attribute($value)
    {
        return url('storage/' . $value);
    }

    public function getImage2Attribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        }
    }

    public function getImage3Attribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        }
    }

    public function getImage4Attribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        }
    }

    /**
     * Get all of the detailTransaction for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class, 'id', 'hostel_room_id');
    }

    /**
     * Get all of the detailTransaction for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransactionHostel()
    {
        return $this->hasMany(DetailTransactionHostel::class, 'id', 'hostel_room_id');
    }

    /**
     * Get the hostel that owns the HostelRoom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function bookDate()
    {
        return $this->hasMany(BookDate::class)->select('id', 'transaction_id', 'hostel_room_id', 'start', 'end');
    }

    public function hostelroomImage()
    {
        return $this->hasMany(HostelRoomImages::class);
    }

    public function hostelFacilities()
    {
        return $this->hasMany(HostelRoomFacility::class);
    }
}
