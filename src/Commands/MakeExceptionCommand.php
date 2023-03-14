<?php

namespace LaravelFlutterGetx\Commands;

use Symfony\Component\Console\Input\InputOption;

class MakeExceptionCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:exception';

    protected $description = 'Create a new exception.';

    protected $type = 'Exception';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }
    }

    protected function replaceWith($stub, $name)
    {
        return str_replace('{{MESSAGE}}', ($this->option('message') ?? ''), $stub);
    }

    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/exception.stub';
    }

    protected function getOptions()
    {
        return array_merge([
            ['message', null, InputOption::VALUE_REQUIRED, 'Exception message']
        ], parent::getOptions());
    }
}
