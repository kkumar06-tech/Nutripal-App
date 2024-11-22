<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    protected $fillable = [
        'user_profile_id',
        'food_id',
        'date',
        'portion',
        'calories'
    ];

    public function foods()
    {
    return $this->belongsToMany(Food::class);
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
