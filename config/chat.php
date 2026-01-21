<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Chat Tables
    |--------------------------------------------------------------------------
    |
    | Table names used by the chat package. If you do not want to use
    | guests or bots, set the corresponding entry to false (e.g.:
    | 'guests' => false). The migrations will respect these values.
    |
    */

    'tables' => [
        'rooms' => 'chat_rooms',
        'messages' => 'chat_room_messages',
        'members' => 'chat_room_members',
        'guests' => 'chat_room_guests', //Set up to false or null to disable guests table
        'bots' => 'chat_room_bots', //Set up to false or null to disable bots table
    ],

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | The user model used by the chat package.
    |
    */

    'user_model' => env('CHAT_USER_MODEL', 'App\\Models\\User'),

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Pagination settings for messages and conversations.
    |
    */

    'pagination' => [
        'messages_per_page' => 50,
        'conversations_per_page' => 20,
    ],

];
    /*
    |--------------------------------------------------------------------------
    | Chat Tables
    |--------------------------------------------------------------------------
    |
    | Table names used by the chat package. If you do not want to use
    | guests or bots, set the corresponding entry to `false` (e.g.:
    | 'guests' => false). The migrations will respect these values.
    |
    */

    'tables' => [
        'rooms' => 'chat_rooms',
        'messages' => 'chat_room_messages',
        'members' => 'chat_room_members',
        // Set to `false` to disable creating these tables via migration
        'guests' => 'chat_room_guests',
        'bots' => 'chat_room_bots',
    ],
        'guests' => 'chat_room_guests',
        'bots' => 'chat_room_bots',
    ],

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | Модель пользователя для чата
    |
    */

    'user_model' => env('CHAT_USER_MODEL', 'App\Models\User'),

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Количество сообщений на странице
    |
    */

    'pagination' => [
        'messages_per_page' => 50,
        'conversations_per_page' => 20,
    ],

];
