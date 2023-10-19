<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HostelRating extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class, 'hostel_room_id');
    }
}
