<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $primaryKey = 'message_id';

    protected $fillable = [
        'user_id',
        'send_from_id',
        'send_to_id',
        'content',
        'created_at',
    ];

    public $timestamps = false; // Since `created_at` is handled manually
}
