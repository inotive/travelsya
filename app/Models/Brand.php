<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'image',
    ];

    public function vendor(): HasMany
    {
        return $this->hasMany(CarRentalHasCars::class, 'brand_id', 'id')->orderBy('rental_price_per_day', 'asc');
    }

    /**
     * Get all car models for this brand
     */
    public function carModels(): HasMany
    {
        return $this->hasMany(CarModel::class, 'brand_id', 'id');
    }
}
