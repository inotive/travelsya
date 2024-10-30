<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'image',
    ];

    public function clinicPackages()
    {
        return $this->hasMany(ClinicHasPackages::class, 'clinic_id', 'id');
    }

    public function categoriesServices()
{
    return $this->hasManyThrough(
        CategoriesServices::class, // Model tujuan
        ClinicHasPackages::class,  // Model perantara
        'clinic_id',               // Foreign key di ClinicHasPackages (tabel perantara)
        'id',                      // Foreign key di CategoriesServices
        'id',                      // Local key di Clinics
        'categories_services_id'    // Foreign key di ClinicHasPackages yang merujuk ke CategoriesServices
    );
}

    

    
}
