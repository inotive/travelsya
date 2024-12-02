<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransactionHealthBeauty extends Model
{
    use HasFactory;

    protected $fillable = [
        "transaction_id",
        "clinic_id",
        "clinic_package_id",
        "category",
        "booking_id",
        "expire_on",
        "rent_price",
        "fee_admin",
        "kode_unik",
        "is_used",
        "total_ticket",
        "customer_name",
        "customer_phone",
        "customer_email",
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
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }
    public function package(): BelongsTo
    {
        return $this->belongsTo(ClinicHasPackages::class, 'clinic_package_id', 'id');
    }
}
