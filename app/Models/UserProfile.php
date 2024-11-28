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
        'weekly_exercise_frequency',
        'daily_goal_ml',
        'daily_goal_calories',
        'profile_image'
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

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
