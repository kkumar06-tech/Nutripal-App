<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_profile_id',
        'nutritionists_id',
        'date',
        'time'
    ];



    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
    
    public function nutritionist()
    {
        return $this->belongsTo(NutritionistProfile::class);
    }
}
