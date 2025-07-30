<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RecreationPackagesImages extends Model
{
    use HasFactory;

    protected $fillable = [
        "recreation_package_id",
        "image",
        "main",
    ];

    public function getImageAttribute($value)
    {
        return Storage::url($value);
    }

}

