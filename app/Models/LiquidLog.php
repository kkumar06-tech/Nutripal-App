<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterLog extends Model
{
    protected $table = 'liquid_logs';

    protected $fillable = [
        'user_profile_id',
        'liquid_id',
        'date',
        'amount_ml',
    ];

    public function updateTotalAmount()
    {
        // Sum the 'amount_ml' values from the pivot table
        $totalAmountMl = $this->liquids->sum(function ($liquid) {
            return $liquid->pivot->amount_ml;
        });

        // Update the total_amount_ml field in the LiquidLog table
        $this->update(['total_amount_ml' => $totalAmountMl]);
    }

    public function liquid()
    {
        return $this->belongsToMany(Liquid::class, 'liquid_log_liquid');
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'id');
    }
}
