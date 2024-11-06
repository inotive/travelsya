<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relasi ke tabel clinic_has_packages
    public function clinicHasPackages()
    {
        return $this->hasMany(ClinicHasPackages::class, 'categories_services_id');
    }
}
