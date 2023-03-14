<?php

namespace LaravelFlutterGetx\Commands;

use Symfony\Component\Console\Input\InputOption;

class MakeProviderCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:provider';

    protected $description = 'Create a new Provider.';

    protected $type = 'Provider';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }
    }

    protected function replaceWith($stub, $name)
    {
    }

    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/provider' . ($this->option('sample') ? 'sample' : '') . '.stub';
    }

    protected function getOptions()
    {
        return array_merge([
            ['sample', null, InputOption::VALUE_NONE, 'Create Provider with sample method.']
        ], parent::getOptions());
    }
}
