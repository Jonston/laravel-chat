<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Chat message model.
 */
class Message extends Model
{
    protected $table = 'chat_room_messages';

    protected $fillable = [
        'text',
        'room_id',
        'member_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
