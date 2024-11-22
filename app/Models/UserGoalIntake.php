<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGoalIntake extends Model
{
    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
