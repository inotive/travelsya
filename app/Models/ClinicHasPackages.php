<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class ClinicHasPackages extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'categories_services_id',
        'specialist_id',
        'name',
        'rules',
        'description',
        'duration',
        'unit_price',
        'price',
        'is_active',
        'image',
        'duration_type',
        'discount_type',
        'discount',
        'expiry_date'
    ];

    protected $appends = [
        'formatted_price',
        'full_duration',
        'main_image_url',
        'average_rating',
        'total_reviews'
    ];

    protected $casts = [
        'price' => 'decimal:0',
        'is_active' => 'boolean',
        'discount' => 'decimal:0',
        'expiry_date' => 'integer',
        'duration' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk data dengan discount
    public function scopeWithDiscount($query)
    {
        return $query->where('discount', '>', 0);
    }

    // Scope untuk mencari berdasarkan nama
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }

    // Relasi ke CategoriesServices
    public function categoriesService(): BelongsTo
    {
        return $this->belongsTo(CategoriesServices::class, 'categories_services_id');
    }

    // Relasi ke Specialist
    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }

    // Relasi ke Clinic
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

    // Relasi ke images
    public function images(): HasMany
    {
        return $this->hasMany(ClinicPackageImages::class, 'clinic_package_id');
    }

    // Relasi ke facilities
    public function facilities(): HasMany
    {
        return $this->hasMany(ClinicPackageFacilities::class, 'clinic_package_id');
    }

    // Relasi ke main image
    public function image(): HasOne
    {
        return $this->hasOne(ClinicPackageImages::class, 'clinic_package_id')->where('main', 1);
    }

    // Relasi ke reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(ClinicRating::class, 'clinic_package_id')->orderBy('created_at', 'desc');
    }

    // Accessor untuk formatted price
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->price, 0, ',', '.')
        );
    }

    // Accessor untuk durasi lengkap
    protected function fullDuration(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->duration . ' ' . $this->duration_type
        );
    }

    // Accessor untuk URL gambar utama
    protected function mainImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->image && $this->image->image) {
                    return Storage::url($this->image->image);
                }
                
                // Fallback ke gambar default jika tidak ada
                return asset('images/default-package.jpg');
            }
        );
    }

    // Accessor untuk average rating
    protected function averageRating(): Attribute
    {
        return Attribute::make(
            get: function () {
                $rating = $this->reviews()->avg('rate');
                return $rating ? round($rating, 1) : 0;
            }
        );
    }

    // Accessor untuk total reviews
    protected function totalReviews(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->reviews()->count()
        );
    }

    // Method untuk menghitung harga setelah discount
    public function getDiscountedPrice()
    {
        if ($this->discount <= 0) {
            return $this->price;
        }

        if ($this->discount_type === 'percentage') {
            return $this->price - ($this->price * $this->discount / 100);
        }

        return $this->price - $this->discount;
    }

    // Method untuk formatted discounted price
    public function getFormattedDiscountedPrice()
    {
        return 'Rp ' . number_format($this->getDiscountedPrice(), 0, ',', '.');
    }

    // Method untuk check jika ada discount
    public function hasDiscount()
    {
        return $this->discount > 0;
    }

    // Method untuk menghitung rating persentase
    public function getRatingPercentage($stars)
    {
        $totalReviews = $this->reviews()->count();
        if ($totalReviews === 0) {
            return 0;
        }

        $starReviews = $this->reviews()->where('rate', $stars)->count();
        return ($starReviews / $totalReviews) * 100;
    }

    // Method untuk avgRating
    public function avgRating()
    {
        $rating = $this->reviews()->avg('rate');
        return $rating ? round($rating, 1) : 0;
    }

    // Event handlers untuk cleanup
    protected static function boot()
    {
        parent::boot();

        // Hapus gambar terkait saat package dihapus
        static::deleting(function ($package) {
            // Hapus semua gambar dari storage
            foreach ($package->images as $image) {
                if (Storage::exists($image->image)) {
                    Storage::delete($image->image);
                }
                $image->delete();
            }

            // Hapus facilities
            $package->facilities()->delete();

            // Hapus reviews
            $package->reviews()->delete();
        });
    }
}