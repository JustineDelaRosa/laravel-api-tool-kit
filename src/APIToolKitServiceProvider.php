<?php

namespace Essa\APIToolKit;

use Illuminate\Support\ServiceProvider;
use Essa\APIToolKit\Commands\MakeEnumCommand;
use Essa\APIToolKit\Commands\GeneratorCommand;
use Essa\APIToolKit\Commands\MakeActionCommand;
use Essa\APIToolKit\Commands\MakeFilterCommand;
use Essa\APIToolKit\Commands\GeneratePermissions;

class APIToolKitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        $this->AddConfigFiles();

        $this->registerCommands();
    }

    public function AddConfigFiles(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/api-tool-kit.php', 'api-tool-kit');

        if ($this->app->runningInConsole() && function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/../config/api-tool-kit.php' => config_path('api-tool-kit.php'),
            ], 'config');
        }
    }

    public function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GeneratorCommand::class,
                MakeActionCommand::class,
                MakeEnumCommand::class,
                GeneratePermissions::class,
                MakeFilterCommand::class
            ]);
        }
    }
}
