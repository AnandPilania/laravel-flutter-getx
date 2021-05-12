<?php

namespace KSPEdu\LaravelFlutterGetx;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use KSPEdu\LaravelFlutterGetx\Commands\CreateProjectCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeBindingCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeControllerCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeExceptionCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeLangCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeMockCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeModelCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeProviderCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeServiceCommand;
use KSPEdu\LaravelFlutterGetx\Commands\MakeViewCommand;

class ServiceProvider extends BaseServiceProvider
{
    protected $rawConfig = __DIR__ . '/../config/ksp-lfg.php';

    public function boot()
    {
        $this->configurePublishing();
        $this->configureRoutes();
    }

    public function register()
    {
        $this->mergeConfigFrom($this->rawConfig, 'ksp-lfg');
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
                $this->rawConfig => config_path('ksp-lfg.php'),
            ], 'ksp-lfg');
        }
    }

    protected function configureRoutes()
    {
        if (config('ksp-lfg.config.enabled')) {
            Route::group([
                'prefix' => 'api',
                'namespace' => 'KSPLaravel\FlutterGetx\Controllers',
                //'middleware' => (config('ksp-lfg.config.middleware.enabled') ? config('ksp-lfg.config.middleware.middlewares') : []),
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
