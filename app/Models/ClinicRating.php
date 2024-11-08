<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'clinic_id',
        'clinic_package_id',
        'user_id',
        'rate',
        'comment',
    ];
}
