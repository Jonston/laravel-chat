<?php

namespace Jonston\LaravelChat;

use Illuminate\Support\ServiceProvider;
use Jonston\LaravelChat\Console\InstallChatCommand;

class LaravelChatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Публикация конфигурации
        $this->publishes([
            __DIR__.'/../config/chat.php' => config_path('chat.php'),
        ], 'chat-config');

        // Публикация миграций
        $this->publishes([
            __DIR__.'/../database/migrations/create_chat_tables.php' => database_path('migrations/'.date('Y_m_d_His').'_create_chat_tables.php'),
        ], 'chat-migrations');

        // Групповой тег для быстрой установки
        $this->publishes([
            __DIR__.'/../config/chat.php' => config_path('chat.php'),
            __DIR__.'/../database/migrations/create_chat_tables.php' => database_path('migrations/'.date('Y_m_d_His').'_create_chat_tables.php'),
        ], 'chat');

        // Загрузка миграций (если нужно запускать напрямую)
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            // Регистрация консольных команд
            $this->commands([
                InstallChatCommand::class,
            ]);
        }
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Объединение конфигурации
        $this->mergeConfigFrom(
            __DIR__.'/../config/chat.php',
            'chat'
        );
    }
}
