<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recreation extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'user_id',
        'is_active',
        'city',
        'phone',
        'address',
    ];

}
