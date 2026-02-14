<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HealthBeautyTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'user_id',
        'package_id',
        'total_price',
        'payment_status',
        'purchase_date',
        'expiry_date',
        'notes'
    ];

    protected $dates = ['purchase_date', 'expiry_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(HealthBeautyPackage::class);
    }

    // Scope untuk transaksi aktif
    public function scopeActive($query)
    {
        return $query->where('payment_status', 'paid')
                    ->where('expiry_date', '>=', Carbon::now());
    }

    // Scope untuk transaksi kedaluwarsa
    public function scopeExpired($query)
    {
        return $query->where('payment_status', 'paid')
                    ->where('expiry_date', '<', Carbon::now());
    }

    // Scope untuk transaksi pending
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    // Accessor untuk status transaksi
    public function getTransactionStatusAttribute()
    {
        $now = Carbon::now();
        
        if ($this->payment_status == 'paid') {
            if ($this->expiry_date->gt($now)) {
                return 'Aktif';
            } else {
                return 'Kedaluwarsa';
            }
        } else {
            return 'Menunggu Pembayaran';
        }
    }

    // Accessor untuk class status
    public function getStatusClassAttribute()
    {
        $status = $this->transaction_status;
        
        switch ($status) {
            case 'Aktif':
                return 'badge-success';
            case 'Kedaluwarsa':
                return 'badge-danger';
            case 'Menunggu Pembayaran':
                return 'badge-warning';
            default:
                return 'badge-secondary';
        }
    }

    // Accessor untuk format harga
    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}