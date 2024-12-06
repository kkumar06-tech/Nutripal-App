<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionalValue extends Model
{

    protected $fillable = [
        'recipe_id',
        'calories',
        'carbohydrates',
        'protein',
        'fats'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
