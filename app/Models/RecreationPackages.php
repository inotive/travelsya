<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RecreationPackages extends Model
{
    use HasFactory;

    protected $table = 'recreation_has_packages';

    protected $fillable = [
        "recreation_id",
        "category_recreation_id",
        "name",
        "rules",
        "description",
        "duration",
        "expiry_date",
        "expiry_type",
        "unit_price",
        "price",
        "is_active",
        "is_refundable",
        "is_reschedule",
        "has_weekend",
        "weekend_price",
    ];

    /**
     * Get the category that owns the RecreationPackages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryRecreation::class, 'category_recreation_id', 'id');
    }

    /**
     * Get the recreation that owns the RecreationPackages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recreation(): BelongsTo
    {
        return $this->belongsTo(Recreation::class, 'recreation_id', 'id');
    }

    /**
     * Get all of the images for the RecreationPackages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(RecreationPackagesImages::class, 'recreation_package_id', 'id');
    }

    /**
     * Get the image associated with the RecreationPackages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image(): HasOne
    {
        return $this->hasOne(RecreationPackagesImages::class, 'recreation_package_id', 'id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(RecreationRatings::class, 'recreation_packages_id', 'id')->orderBy('created_at', 'desc');
    }

    public function avgRating()
    {
        $rating = RecreationRatings::where('recreation_packages_id', $this->id)->get()->pluck('rate')->toArray();
        $data = count($rating);

        if($data > 0){
            $avg = array_sum($rating) / $data;

            return round($avg, 1);
        }else{
            return 0;
        }
    }
}
