<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_profile_id',
        'nutritionist_profile_id',
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
