<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostelRoomImages extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class);
    }
}
