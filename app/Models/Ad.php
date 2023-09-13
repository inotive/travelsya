<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // public function getImageAttribute($value)
    // {
    //     return url('storage/' . $value);
    // }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/ads/' . $image),
        );
    }
}
