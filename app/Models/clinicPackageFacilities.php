<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class clinicPackageFacilities extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_package_id',
        'clinic_facilities_id',
    ];

    /**
     * Get the package that owns the clinicPackageFacilities
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(ClinicHasPackages::class, 'clinic_package_id', 'id');
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(clinicFacilities::class, 'clinic_facilities_id', 'id');
    }
}
