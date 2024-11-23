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

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
