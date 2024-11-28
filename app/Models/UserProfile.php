<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'date_of_birth',
        'weight',
        'height',
        'gender',
        'fitness_goal',
        'weekly_exercise_frequency'
    ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favoriteRecipes(){
        return $this->belongsToMany(Recipe::class, 'user_favorite_recipes');
    }
    
    public function mealPlans(){
        return $this->belongsToMany(MealPlan::class); 
    }
    
    public function liquidLogs()
    {
        return $this->hasMany(LiquidLog::class);
    }
}
