<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HostelRating extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class, 'hostel_room_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
