<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

class MakeModelCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:model';

    protected $description = 'Create a new model.';

    protected $type = 'Model';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }
    }

    protected function replaceWith($stub, $name) {}
    
    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/model.stub';
    }
}
