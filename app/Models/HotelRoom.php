<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $guarded = [];

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
     * Get the hostel that owns the HostelRoom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookDate()
    {
        return $this->hasMany(BookDate::class)->select('id', 'transaction_id', 'hostel_room_id', 'start', 'end');
    }
}
