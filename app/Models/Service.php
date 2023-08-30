<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * Get all of the product for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all of the hostel for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hostel()
    {
        return $this->hasMany(Hostel::class);
    }

    /**
     * Get all of the point for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function point()
    {
        return $this->hasMany(Point::class);
    }

    /**
     * Get all of the management-fee for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fee()
    {
        return $this->hasMany(Fee::class);
    }
}
