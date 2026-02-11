<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarImage extends Model
{
    use HasFactory;

    protected $table = 'car_images';

    protected $fillable = [
        'car_rental_has_cars_id',
        'image_url',
        'main',
    ];

    /**
     * Get the car that owns the image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(CarRentalHasCars::class, 'car_rental_has_cars_id', 'id');
    }
}
