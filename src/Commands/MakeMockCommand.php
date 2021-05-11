<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

class MakeMockCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:mock';

    protected $description = 'Create a new mock.';

    protected $type = 'Mock';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }
    }

    protected function replaceWith($stub, $name) {}
    
    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/mock.stub';
    }
}
