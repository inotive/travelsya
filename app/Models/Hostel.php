<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;

    protected $guarded = [];

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
}
