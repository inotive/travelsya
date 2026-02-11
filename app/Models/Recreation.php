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
        return $this->hasMany(DetailTransactionRecreation::class, 'recreation_id', 'id');
    }

    /**
     * Get the city that owns the Recreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kota(): BelongsTo
    {
        // Relasi default: menghubungkan kolom 'city' dengan 'city_id' di tabel cities
        // Ini bekerja jika kolom 'city' berisi ID kota
        return $this->belongsTo(City::class, 'city', 'city_id');
    }
    
    /**
     * Get the city name either from the related City model or directly from the 'city' column
     *
     * @return string
     */
    public function getCityNameAttribute(): string
    {
        // Jika relasi kota berhasil dimuat, kembalikan nama kotanya
        if ($this->relationLoaded('kota') && $this->kota) {
            return $this->kota->city_name;
        }
        
        // Cek apakah nilai 'city' adalah angka (city_id) atau string (kemungkinan nama kota)
        if (is_numeric($this->city)) {
            // Jika ini adalah ID kota, coba ambil nama kota dari database
            $city = City::where('city_id', $this->city)->first();
            if ($city) {
                return $city->city_name;
            }
        }
        
        // Jika bukan angka atau tidak ditemukan di tabel cities, kembalikan nilai aslinya atau default
        return $this->city ?? 'Kota dihapus';
    }

    /**
     * Get all of the images for the Recreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(recreationImages::class, 'recreation_id', 'id')->orderBy('id', 'desc');
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

    public function categoryRecreation()
    {
        return $this->belongsTo(CategoryRecreation::class);
    }

    public function avgRating()
    {
        $rating = RecreationRatings::where('recreation_id', $this->id)->get()->pluck('rate')->toArray();

        $data = count(value: $rating);

        if($data > 0){
            $avg = array_sum($rating) / $data;

            return round($avg, 1);
        }else{
            return 0;
        }

    }
}
