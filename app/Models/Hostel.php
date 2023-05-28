<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the detailTransaction for the Hostel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class, 'id', 'hostel_room_id');
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
}
