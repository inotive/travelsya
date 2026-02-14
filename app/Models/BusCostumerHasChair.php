<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusCostumerHasChair extends Model
{
    protected $fillable = [
        'id_costumer',
        'id_departure',
        'penumpang_ke',
        'is_pulang_pergi',
        'date_pergi',
        'date_pulang',
        'kursi_pergi',
        'kursi_pulang',
        'is_active'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_costumer', 'id');
    }

    public function departure(){
        return $this->belongsTo(BusDeparture::class, 'id_departure', 'id');
    }
}
