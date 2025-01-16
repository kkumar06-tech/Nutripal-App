<?php

namespace App\Models;

use App\Models\UserProfile;
use App\Models\NutritionistProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'nutritionist_id',
        'message',
        'type',
    ];

    public function nutritionistProfile()
    {
        return $this->belongsTo(NutritionistProfile::class, 'nutritionist_id');
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'user_profile_id');
    }
}
