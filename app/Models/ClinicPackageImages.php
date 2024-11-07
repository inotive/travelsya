<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicPackageImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_package_id',
        'image',
        'main',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(ClinicHasPackages::class, 'clinic_package_id', 'id');
    }
}
