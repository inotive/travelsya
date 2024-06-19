<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;


    protected $fillable = [
        'prov_id',
        'prov_name',
        'locationid',
        'status'
    ];
}
