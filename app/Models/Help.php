<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function createdBy()
{
    return $this->belongsTo(User::class, 'created_by');
}
}
