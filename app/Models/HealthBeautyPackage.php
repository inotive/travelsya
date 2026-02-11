<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthBeautyPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'validity_days',
        'is_active'
    ];

    public function transactions()
    {
        return $this->hasMany(HealthBeautyTransaction::class);
    }
}