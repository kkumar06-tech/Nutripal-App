<?php

namespace App\Models;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;

class NutritionistProfile extends Model
{
    protected $fillable = [
        'user_id', 
        'name',
        'certificate_image', 
        'credentials',
        'profile_image', 
        'bio_description'
    ];




    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'nutritionist_profile_id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'nutritionist_id');
    }

    
}
