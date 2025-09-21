<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'brand_id',
    ];

    /**
     * Get all of the vendor for the CarModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendor(): HasMany
    {
        return $this->hasMany(CarRentalHasCars::class, 'car_model_id', 'id');
    }

    /**
     * Get the brand that owns the car model
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function carRentalHasCars(): HasMany
    {
        return $this->hasMany(CarRentalHasCars::class, 'car_model_id', 'id');
    }

}
