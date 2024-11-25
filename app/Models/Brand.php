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
    ];

    public function vendor(): HasMany
    {
        return $this->hasMany(CarRentalHasCars::class, 'brand_id', 'id')->orderBy('rental_price_per_day', 'asc');
    }
}
