<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    
    protected $fillable = [
        'name',
        'meal_type',
        'calories',
        'protein',
        'carbs',
        'fat',
        'portion',
        'food_image'
    ];


    public function foodlogs()
{
    return $this->belongsToMany(FoodLog::class);
}
}
