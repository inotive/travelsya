<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransactionRecreation extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'detail_transaction_recreations';

    protected $fillable = [
        "transaction_id",
        "recreation_id",
        "recreationPackage_id",
        "booking_id",
        "expire_on",
        "rent_price",
        "fee_admin",
        "kode_unik",
        "is_used",
        "book_date",
        "total_ticket",
        "customer_name",
        "customer_phone",
        "customer_email",
        "customer_country",
    ];

    /**
     * Get the transaction that owns the detailTransactionRecreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
    public function recreation(): BelongsTo
    {
        return $this->belongsTo(Recreation::class, 'recreation_id', 'id');
    }
    public function package(): BelongsTo
    {
        return $this->belongsTo(RecreationPackages::class, 'recreationPackage_id', 'id');
    }
}
