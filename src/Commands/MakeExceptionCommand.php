<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

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

    protected function replaceWith($stub, $name) {}
    
    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/exception.stub';
    }
}
