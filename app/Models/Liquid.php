<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquid extends Model
{
    
    protected $fillable = [
        'name',
        'ml_amount'
    ];


    public function logs()
    {
        return $this->belongsToMany(LiquidLog::class,'liquid_log_liquid');
    }
}
