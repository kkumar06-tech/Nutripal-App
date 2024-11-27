<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class receiver extends Model
{
    protected $fillable = ['user_id','content'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
