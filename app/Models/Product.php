<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Get all of the detailTransaction for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class, 'id', 'product_id');
    }
}
