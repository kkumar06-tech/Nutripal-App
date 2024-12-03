<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquid extends Model
{
    protected $table = 'water';
    
    protected $fillable = [
        'name',
        'calories',
        'protein',
        'carbs',
        'fat',
    ];


    public function logs()
    {
        return $this->hasMany(LiquidLog::class);
    }
}
