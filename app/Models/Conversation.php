<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    protected $fillable = ['user_id', 'sender_id', 'receiver_id', 'content'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function sender(){
        return $this->belongsTo(Sender::class);
    }

    public function receiver(){
        return $this->belongsTo(Receiver::class);
    }
}
