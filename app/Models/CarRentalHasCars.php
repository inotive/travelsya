<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarRentalHasCars extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_rental_id',
        'image_url',
        'brand_id',
        'car_model_id',
        'policy_id',
        'number_seats',
        'category_rent',
        'rental_price_per_day',
        'status',
        'description',
        'category'
    ];

    // Definisikan relasi ke model Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Definisikan relasi ke model CarModel
    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    // Definisikan relasi ke model Policy
    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }

    // Definisikan relasi ke model CarRental
    public function carRental()
    {
        return $this->belongsTo(CarRental::class);
    }

}
