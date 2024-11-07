<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    ];

    public function categoriesService()
    {
        return $this->belongsTo(CategoriesServices::class, 'categories_services_id');
    }

    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }

    // Relasi many-to-one ke model Clinic
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    /**
     * Get all of the images for the ClinicHasPackages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ClinicPackageImages::class, 'clinic_package_id', 'id');
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(clinicPackageFacilities::class, 'clinic_package_id', 'id');
    }

    public function image(): HasOne
    {
        return $this->hasOne(ClinicPackageImages::class, 'clinic_package_id', 'id')->where('main', 1);
    }
}
