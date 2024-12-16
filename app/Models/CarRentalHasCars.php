<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function PHPUnit\Framework\returnSelf;

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
        'category',
        'koper',
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

    /**
     * Get all of the booked for the CarRentalHasCars
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booked(): HasMany
    {
        return $this->hasMany(CarBookDate::class, 'car_rental_has_car_id', 'id');
    }

    // Definisikan relasi ke model CarRental
    public function carRental()
    {
        return $this->belongsTo(CarRental::class);
    }

    public function city(){
        return $this->belongsTo(City::class, 'city', 'city_id');
    }

    public function carRentalRate(): HasMany
    {
        return $this->hasMany(CarRentalRating::class, 'car_rental_has_car_id', 'id');
    }



    public function scopeActive()
    {
        return $this->where('status', "1");
    }

    public function scopeFilter($query, array $filters, int $location = null){
        $query->when($filters['mdoel_id'] ?? false, fn($query, $model_id) =>
            $query->where('car_model_id', $model_id)
        );

        $query->when($location ?? false, fn($query, $location) =>
            $query->whereHas('city', fn($query) =>
                $query->where('city', $location)
            )
        );
    }
}
