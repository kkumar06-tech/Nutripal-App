<?php

namespace App\Models;

use App\Models\Notification;
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

    public function foodLogs()
    {
        return $this->hasMany(FoodLog::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function userStat(){
        return $this->hasMany(UserStat::class);
    }

    public function userAppointment(){
        return $this->hasMany(Appointment::class, 'user_profile_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_profile_id');
    }
}
