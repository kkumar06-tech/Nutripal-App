<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    protected $fillable = [
        'user_profile_id',
        'date',
    ];


    protected static function booted()   //the date will automatically be set to current date, when we call Create::...
    {
        static::creating(function ($foodLog) {
            if (!$foodLog->date) { //checks if date exists
                $foodLog->date = now()->format('Y-m-d'); 
            }
        });

        static::updating(function ($foodLog) {
            if (!$foodLog->date) { // Check if 'date' exists
                $foodLog->date = now()->format('Y-m-d');  }
            });
    }

   

    public function foods()
    {
    return $this->belongsToMany(Food::class);
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
