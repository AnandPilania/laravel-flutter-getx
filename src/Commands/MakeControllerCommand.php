<?php

namespace LaravelFlutterGetx\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeControllerCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:controller';

    protected $description = 'Create a new controller.';

    protected $type = 'Controller';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }
    }

    protected function replaceWith($stub, $name)
    {
        $provider = $this->option('provider') ?? '';

        $providerReplaced = str_replace('{{PROVIDER}}', Str::title($provider), $stub);
        $sProviderReplaces = str_replace('{{SPROVIDER}}', $this->getFlutteredName($provider), $providerReplaced);

        return $sProviderReplaces;
    }

    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/controller' . ($this->option('provider') ? '.provider' : '') . '.stub';
    }

    protected function getOptions()
    {
        return array_merge([
            ['provider', null, InputOption::VALUE_REQUIRED, 'Create controller with provider.']
        ], parent::getOptions());
    }
}
