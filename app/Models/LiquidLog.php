<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiquidLog extends Model
{
    protected $table = 'liquid_logs';

    protected $fillable = [
        'user_profile_id',
        'date',
        'total_amount_ml',
    ];


    protected static function booted()
    {
        static::creating(function ($liquidLog) {
            // check if the date is not set
            if (!$liquidLog->date) {
                // if the date is not set, set it to today's date
                $liquidLog->date = now()->format('Y-m-d'); 
            }
        });


        static::updating(function ($liquidLog) {
            // check if the date is not set
            if (!$liquidLog->date) {
                // if the date is not set, set it to today's date
                $liquidLog->date = now()->format('Y-m-d'); 
            }
        });
    }

  

    public function liquids()
    {
        return $this->belongsToMany(Liquid::class, 'liquid_log_liquid');
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'id');
    }
}
