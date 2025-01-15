<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquid extends Model
{
    
    protected $fillable = [
        'name',
    ];


    public function liquidlogs()
    {
        return $this->belongsToMany(LiquidLog::class,'liquid_log_liquid');
    }
}
