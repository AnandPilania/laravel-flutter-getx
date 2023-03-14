<?php

namespace LaravelFlutterGetx;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelFlutterGetx\Commands\CreateProjectCommand;
use LaravelFlutterGetx\Commands\MakeBindingCommand;
use LaravelFlutterGetx\Commands\MakeControllerCommand;
use LaravelFlutterGetx\Commands\MakeExceptionCommand;
use LaravelFlutterGetx\Commands\MakeLangCommand;
use LaravelFlutterGetx\Commands\MakeMockCommand;
use LaravelFlutterGetx\Commands\MakeModelCommand;
use LaravelFlutterGetx\Commands\MakeProviderCommand;
use LaravelFlutterGetx\Commands\MakeServiceCommand;
use LaravelFlutterGetx\Commands\MakeViewCommand;

class ServiceProvider extends BaseServiceProvider
{
    protected $rawConfig = __DIR__ . '/../config/laravel-flutter-getx.php';

    public function boot()
    {
        $this->configurePublishing();
        $this->configureRoutes();
    }

    public function register()
    {
        $this->mergeConfigFrom($this->rawConfig, 'laravel-flutter-getx');
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateProjectCommand::class,
                MakeBindingCommand::class,
                MakeControllerCommand::class,
                MakeExceptionCommand::class,
                MakeLangCommand::class,
                MakeMockCommand::class,
                MakeModelCommand::class,
                MakeProviderCommand::class,
                MakeServiceCommand::class,
                MakeViewCommand::class,
            ]);
        }
    }

    protected function configurePublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->rawConfig => config_path('laravel-flutter-getx.php'),
            ], 'laravel-flutter-getx');
        }
    }

    protected function configureRoutes()
    {
        if (config('laravel-flutter-getx.config.enabled')) {
            Route::group([
                'prefix' => 'api',
                'namespace' => 'LaravelFlutterGetx\Http\Controllers',
                //'middleware' => (config('laravel-flutter-getx.config.middleware.enabled') ? config('laravel-flutter-getx.config.middleware.middlewares') : []),
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
            });
        }
    }

    public function provides()
    {
        return [
            CreateProjectCommand::class,
            MakeBindingCommand::class,
            MakeControllerCommand::class,
            MakeExceptionCommand::class,
            MakeLangCommand::class,
            MakeMockCommand::class,
            MakeModelCommand::class,
            MakeProviderCommand::class,
            MakeServiceCommand::class,
            MakeViewCommand::class,
        ];
    }
}
