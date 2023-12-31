<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostelImage extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function hostel()
    {
        $this->belongsTo(Hostel::class);
    }
}
