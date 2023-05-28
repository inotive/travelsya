<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * Get the transaction that owns the DetailTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Get the hostel that owns the DetailTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class, 'hostel_room_id', 'id');
    }

    /**
     * Get the product that owns the DetailTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
