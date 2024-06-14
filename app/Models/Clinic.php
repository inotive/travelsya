<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;


    protected $fillable = [
        'clinic_name',
        'user_id',
        'is_active',
        'city',
        'phone',
        'address',
    ];


}
