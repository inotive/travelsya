<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
}
