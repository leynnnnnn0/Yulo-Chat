<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;
    protected $table = 'messages';

    protected $fillable = [
        'user_id',
        'receiver_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
