<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Facility extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // protected function icon(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($icon) => asset('/storage/facilities/' . $icon),
    //     );
    // }

    public function hotelroomFacility()
    {
        return $this->hasMany(HotelRoomFacility::class);
    }
}
