<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    
    protected $fillable = [
        'name',
        'calories',
        'protein',
        'carbs',
        'fat',
    ];


    public function foodlogs()
{
    return $this->belongsToMany(FoodLog::class);
}
}
