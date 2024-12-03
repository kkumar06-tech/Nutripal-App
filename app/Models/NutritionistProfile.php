<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionistProfile extends Model
{
    protected $fillable = [
        'user_id', 
        'certificate_image', 
        'credentials',
        'profile_image', 
        'bio_description'
    ];




    public function user()
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'nutritionists_id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function nutriotionistAppointment(){
        return $this->hasMany(Appointment::class, foreignKey: 'nutriotionists_id');
    }
}
