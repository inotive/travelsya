<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'clinic_id',
        'clinic_package_id',
        'user_id',
        'rate',
        'comment',
    ];

    /**
     * Get the user that owns the ClinicRating
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
