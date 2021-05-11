<?php

namespace KSPEdu\LaravelFlutterGetx;

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
    public function boot()
    {
        $rawConfig = __DIR__ . '/../config/ksp-lfg.php';

        $this->configurePublishing($rawConfig);

        $this->mergeConfigFrom($rawConfig, 'ksp-lfg');
    }

    public function register()
    {
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

    protected function configurePublishing($rawConfig)
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $rawConfig => config_path('ksp-lfg.php'),
            ], 'ksp-lfg');
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
