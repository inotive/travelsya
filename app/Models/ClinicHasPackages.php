<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
