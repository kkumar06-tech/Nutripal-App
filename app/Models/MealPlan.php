<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = ['user_id', 'recipe_id', 'date'];

    public function userProfiles(){
        return $this->belongsTo(UserProfile::class);
    }
    
    public function recipes(){
        return $this->belongsToMany(Recipe::class);
    }
}
