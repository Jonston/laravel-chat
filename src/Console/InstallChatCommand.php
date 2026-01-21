<?php

namespace Jonston\LaravelChat\Console;

use Illuminate\Console\Command;
class InstallChatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:install {--migrate : Run migrations after publishing} {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Laravel Chat package (publish config, migrations)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $force = $this->option('force') ? ['--force' => true] : [];

        $this->info('Publishing configuration...');
        $this->call('vendor:publish', array_merge([
            '--tag' => 'chat-config',
            '--provider' => 'Jonston\\LaravelChat\\LaravelChatServiceProvider',
        ], $force));

        $this->info('Publishing migrations...');
        $this->call('vendor:publish', array_merge([
            '--tag' => 'chat-migrations',
            '--provider' => 'Jonston\\LaravelChat\\LaravelChatServiceProvider',
        ], $force));

        if ($this->option('migrate')) {
            $this->info('Running migrations...');
            $this->call('migrate');
        }

        $this->info('Chat package installed successfully.');

        return 0;
    }
}
