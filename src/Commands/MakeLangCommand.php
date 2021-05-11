<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

class MakeLangCommand extends FlutterGeneratorCommand
{
    protected $name = 'flutter:make:lang';

    protected $description = 'Create a new lang.';

    protected $type = 'Lang';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }
    }

    protected function replaceWith($stub, $name) {}
    
    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/lang.stub';
    }
}
