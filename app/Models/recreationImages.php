<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class recreationImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'recreation_id',
        'image',
        'main',
    ];

    /**
     * Get the recreation that owns the recreationImages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recreation(): BelongsTo
    {
        return $this->belongsTo(Recreation::class, 'recreation_id', 'id');
    }
}
