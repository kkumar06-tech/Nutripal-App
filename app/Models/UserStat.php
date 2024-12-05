<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStat extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'calories',
        'weight',
        'liquid_intake',
    ];

    protected static function booted()
    {
        static::creating(function ($userStat) {
            
            if (!$userStat->date) {
                
                $userStat->date = now()->format('Y-m-d'); 
            }
        });
    }
    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
