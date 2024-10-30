<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    // Relasi ke tabel clinic_has_packages
    public function clinicHasPackages()
    {
        return $this->hasMany(ClinicHasPackages::class, 'categories_services_id');
    }

    public function clinics()
    {
        return $this->hasManyThrough(
            Clinic::class,              // Model tujuan (Clinic)
            ClinicHasPackages::class,   // Model perantara (ClinicHasPackages)
            'categories_services_id',   // Foreign key di ClinicHasPackages yang mengacu ke CategoriesServices
            'id',                       // Foreign key di Clinic
            'id',                       // Local key di CategoriesServices
            'clinic_id'                 // Foreign key di ClinicHasPackages yang mengacu ke Clinic
        );
    }
    
}
