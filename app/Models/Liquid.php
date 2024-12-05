<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquid extends Model
{
    
    protected $fillable = [
        'name',
        'calories_per_100ml'
    ];


    public function logs()
    {
        return $this->hasMany(LiquidLog::class,'liquid_log_liquid');
    }
}
