<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'user_id',
        'is_active',
        'city',
        'phone',
        'address',
        'kebijakan_rental_mobil',
        'image',
    ];

    /**
     * Get the user that owns the CarRental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kota that owns the CarRental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kota(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city', 'city_id');
    }

    public function hasCars(): HasMany
    {
        return $this->hasMany(CarRentalHasCars::class, 'car_rental_id', 'id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(CarRentalRating::class, 'car_rental_id', 'id')->orderBy('created_at', 'desc');
    }

    public function avgRating()
    {
        $rating = CarRentalRating::where('car_rental_id', $this->id)->get()->pluck('rate')->toArray();

        $data = count($rating);
        if($data > 0){
            $avg = array_sum($rating) / $data;
            return round($avg, 1);
        }else{
            return 0;
        }
    }
}
