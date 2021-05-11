<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

class MakeViewCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:view';

    protected $description = 'Create a new view.';

    protected $type = 'View';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }
    }

    protected function replaceWith($stub, $name) {}
    
    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/view.stub';
    }
}
