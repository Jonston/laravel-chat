<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Guest model for chat visitors.
 */
class Guest extends Model
{
    protected $table = 'chat_room_guests';

    protected $fillable = [
        'name',
        'email',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
