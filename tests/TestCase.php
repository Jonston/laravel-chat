<?php

namespace Jonston\LaravelChat\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Jonston\LaravelChat\LaravelChatServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [LaravelChatServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Use in-memory sqlite for testing
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
