<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Chat room model.
 */
class Room extends Model
{
    protected $table = 'chat_rooms';

    protected $fillable = [
        'name',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id');
    }
}
