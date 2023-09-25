<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoomFacility extends Model
{
    use HasFactory;

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

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
