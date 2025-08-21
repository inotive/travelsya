<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Clinic extends Model
{
    use HasFactory;


    protected $fillable = [
        'clinic_name',
        'user_id',
        'is_active',
        'city',
        'phone',
        'address',
        'category',
        'open',
        'close',
        'description',
        'highlight',
        'badge',
        'lat',
        'ltd',
    ];


    const CATEGORY = [
        'kesehatan' => 'Kesehatan',
        'kecantikan' => 'Kecantikan',
        'spa dan kecantikan' => 'Spa dan Kecantikan',
    ];

    public function packages()
    {
        return $this->hasMany(ClinicHasPackages::class, 'clinic_id', 'id')->orderBy('price');
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city', 'city_id');
    }

    /**
     * Get all of the transactions for the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(DetailTransactionHealthBeauty::class, 'clinic_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeActive()
    {
        return $this->where('is_active', 1);
    }

    public function images(): HasMany
    {
        return $this->hasMany(clinicImages::class, 'clinic_id', 'id');
    }

    /**
     * Get the foto associated with the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image(): HasOne
    {
        return $this->hasOne(clinicImages::class, 'clinic_id', 'id')->where('main', 1);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ClinicRating::class, 'clinic_id', 'id')->orderBy('created_at', 'desc');
    }

    public function avgRating()
    {
        $rating = ClinicRating::where('clinic_id', $this->id)->get()->pluck('rate')->toArray();

        $data = count($rating);

        if($data > 0){
            $avg = array_sum($rating) / $data;

            return round($avg, 1);
        }else{
            return 0;
        }
    }
}
