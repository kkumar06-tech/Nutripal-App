<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    protected $table = 'water';
    
    protected $fillable = [
        'name',
        'calories',
        'protein',
        'carbs',
        'fat',
    ];


    public function foodlogs()
{
    return $this->belongsToMany(WaterLog::class);
}
}
