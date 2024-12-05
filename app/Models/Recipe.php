<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'cooking_time',
        'difficulty',
        'cuisine_type',
        'meal_type',
    ];

    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }

    public function filters(){
        return $this->belongsToMany(Filter::class);
    }

    public function likedByUsers(){
    return $this->belongsToMany(User::class, 'user_favorite_recipes');
    }

    public function mealPlans(){
        return $this->belongsToMany(MealPlan::class);
    }

    public function nutritionalvalue(){
        return $this->hasOne(NutrionalValue::class);
    }

    
}
