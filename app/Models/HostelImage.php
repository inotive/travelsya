<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageAttribute($value)
    {
        return url('storage/' . $value);
    }

    public function hostel()
    {
        $this->belongsTo(Hostel::class);
    }
}
