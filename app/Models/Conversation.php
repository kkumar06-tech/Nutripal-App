<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    protected $fillable = ['user_profile_id', 'nutritionist_id', 'content', 'is_read'];

    public function userProfile(){
        return $this->belongsTo(UserProfile::class);
    }

    public function nutritionist()
    {
        return $this->belongsTo(NutritionistProfile::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class); // each conversation has many messages
    }


}
