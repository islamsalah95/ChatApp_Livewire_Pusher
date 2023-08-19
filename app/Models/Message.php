<?php

namespace App\Models;

use App\Models\User;
use App\Models\Friend_ship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'sender_id',
        'friend_ship_id',
        'created_at',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');

    }

    public function friend_ship()
    {
        return $this->hasOne(Friend_ship::class, 'friend_ship_id');

    }


}
