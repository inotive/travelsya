<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
{
    use HasFactory;

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
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }
}
