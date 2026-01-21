<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Bot model for automated participants.
 */
class Bot extends Model
{
    protected $table = 'chat_room_bots';

    protected $fillable = [
        'name',
        'provider',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
