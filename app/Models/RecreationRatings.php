<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecreationRatings extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'recreation_id',
        'recreation_packages_id',
        'users_id',
        'rate',
        'comment',
    ];

    /**
     * Get the recreation that owns the RecreationRatings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recreation(): BelongsTo
    {
        return $this->belongsTo(Recreation::class, 'recreation_id', 'id');
    }

    /**
     * Get the package that owns the RecreationRatings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(RecreationPackages::class, 'recreation_packages_id', 'id');
    }
}
