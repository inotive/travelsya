<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the detailTransaction for the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function detailTransactionPPOB()
    {
        return $this->hasMany(DetailTransactionPPOB::class, 'transaction_id', 'id');
    }
    public function detailTransactionTopUp()
    {
        return $this->hasMany(DetailTransactionTopUp::class);
    }

    public function detailTransactionHotel()
    {
        return $this->hasMany(DetailTransactionHotel::class);
    }

    public function detailTransactionHostel()
    {
        return $this->hasMany(DetailTransactionHostel::class);
    }


    /**
     * Get all of the product for the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all of the guest for the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guest()
    {
        return $this->hasMany(Guest::class);
    }

    /**
     * Get all of the bookDate for the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookDate()
    {
        return $this->hasMany(BookDate::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function historyPoint()
    {
        return $this->hasMany(HistoryPoint::class);
    }

    public function historyPointIN()
    {
        return $this->hasMany(HistoryPoint::class)->where('flow','debit');
    }

    public function historyPointOut()
    {
        return $this->hasMany(HistoryPoint::class)->where('flow','credit');
    }

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function hostelRating(){
        return $this->hasMany(HostelRating::class);
    }
}
