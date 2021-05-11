<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

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

    protected function replaceWith($stub, $name) {}
    
    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/provider.stub';
    }
}
