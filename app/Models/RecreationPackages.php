<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecreationPackages extends Model
{
    use HasFactory;

    protected $table = 'recreation_has_packages';

    protected $fillable = [
        "recreation_id",
        "category_recreation_id",
        "name",
        "rules",
        "description",
        "duration",
        "expiry_date",
        "expiry_type",
        "unit_price",
        "price",
        "is_active",
        "is_refundable",
        "is_reschedule",
    ];

    /**
     * Get the category that owns the RecreationPackages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryRecreation::class, 'category_recreation_id', 'id');
    }

    /**
     * Get the recreation that owns the RecreationPackages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recreation(): BelongsTo
    {
        return $this->belongsTo(Recreation::class, 'recreation_id', 'id');
    }
}
