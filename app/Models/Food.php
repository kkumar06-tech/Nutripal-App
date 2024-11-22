<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function foodlogs()
{
    return $this->belongsToMany(FoodLog::class);
}
}
