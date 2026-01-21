<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Load table names from config. Entries may be `false` to disable.
        $tables = config('chat.tables', [
            'members' => 'chat_room_members',
            'rooms' => 'chat_rooms',
            'messages' => 'chat_room_messages',
            'guests' => 'chat_room_guests',
            'bots' => 'chat_room_bots',
        ]);

        $useGuests = ! empty($tables['guests']);
        $useBots = ! empty($tables['bots']);

        // Create guests table if enabled (guests are separate from users)
        if ($useGuests) {
            Schema::create($tables['guests'], function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->json('meta')->nullable();
                $table->timestamps();
            });
        }

        // Create bots table if enabled
        if ($useBots) {
            Schema::create($tables['bots'], function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('provider')->nullable();
                $table->json('meta')->nullable();
                $table->timestamps();
            });
        }

        Schema::create($tables['members'], function (Blueprint $table) {
            $table->id();
            $table->morphs('member');
            $table->timestamps();
        });

        Schema::create($tables['rooms'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create($tables['messages'], function (Blueprint $table) use ($tables) {
            $table->id();
            $table->text('text');
            $table->foreignId('room_id')->constrained($tables['rooms'])->onDelete('cascade');
            $table->foreignId('member_id')->constrained($tables['members'])->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = config('chat.tables', [
            'members' => 'chat_room_members',
            'rooms' => 'chat_rooms',
            'messages' => 'chat_room_messages',
            'guests' => 'chat_room_guests',
            'bots' => 'chat_room_bots',
        ]);

        Schema::dropIfExists($tables['messages']);
        Schema::dropIfExists($tables['members']);
        Schema::dropIfExists($tables['bots']);
        Schema::dropIfExists($tables['guests']);
        Schema::dropIfExists($tables['rooms']);
    }
};
