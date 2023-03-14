<?php

namespace LaravelFlutterGetx\Commands;

class MakeServiceCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:service';

    protected $description = 'Create a new service.';

    protected $type = 'Service';

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
        return __DIR__ . $this->stubPath . '/service.stub';
    }
}
