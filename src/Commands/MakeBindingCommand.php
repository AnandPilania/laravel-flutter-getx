<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeBindingCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:binding';

    protected $description = 'Create a new Binding.';

    protected $type = 'Binding';

    public function handle()
    {
        if($this->option('provider') && !$this->option('controller')) {
            $this->error('Controller is required to use Provider');

            return false;
        }

        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }
    }

    protected function replaceWith($stub, $name) {
        $controller = $this->option('controller') ?? '';
        $provider = $this->option('provider') ?? '';

        $controllerReplaced = str_replace('{{CONTROLLER}}', Str::title($controller), $stub);
        $sControllerReplaced = str_replace('{{SCONTROLLER}}', Str::lower($controller), $controllerReplaced);
        $providerReplaced = str_replace('{{PROVIDER}}', Str::title($provider), $sControllerReplaced);
        $sProviderReplaced = str_replace('{{SPROVIDER}}', Str::lower($provider), $providerReplaced);

        return $sProviderReplaced;
    }

    protected function getStub()
    {
        $stub = __DIR__ . $this->stubPath . '/binding';

        if($this->option('controller') && $this->option('provider') || $this->option('provider')) {
            return $stub .= '.controller.provider.stub';
        }
        
        if($this->option('controller')) {
            $stub .= '.controller';
        }

        return $stub . '.stub';
    }

    protected function getOptions()
    {
        return array_merge([
            ['controller', null, InputOption::VALUE_REQUIRED, 'Make Binding with Controller Only.'],
            ['provider', null, InputOption::VALUE_REQUIRED, 'Make Binding with Controller & Provider.'],
        ], parent::getOptions());
    }
}
