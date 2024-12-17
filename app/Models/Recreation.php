<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recreation extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'category_recreation_id',
        'user_id',
        'is_active',
        'city',
        'phone',
        'address',
        'description',
        'highlight',
        'open',
        'close',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryRecreation::class, 'category_recreation_id', 'id');
    }

    /**
     * Get all of the booked for the Recreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booked(): HasMany
    {
        return $this->hasMany(detailTransactionRecreation::class, 'recreation_id', 'id');
    }

    /**
     * Get the city that owns the Recreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kota(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city', 'city_id');
    }

    /**
     * Get all of the images for the Recreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(recreationImages::class, 'recreation_id', 'id');
    }

    public function image(): HasOne
    {
        return $this->hasOne(recreationImages::class, 'recreation_id', 'id')->where('main', 1);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Get all of the recreationPackage for the Recreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recreationPackages(): HasMany
    {
        return $this->hasMany(RecreationPackages::class, 'recreation_id', 'id')->orderBy('price');
    }

    public function scopeActive()
    {
        return $this->where('is_active', 1);
    }

    /**
     * Get all of the reviews for the Recreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(RecreationRatings::class, 'recreation_id', 'id')->orderBy('created_at', 'desc');
    }

    public function avgRating()
    {
        $rating = RecreationRatings::where('recreation_id', $this->id)->get()->pluck('rate')->toArray();

        $data = count(value: $rating);

        $avg = array_sum($rating) / ($data == 0 ? 1 : $data);

        return round($avg, 1);
    }
}
