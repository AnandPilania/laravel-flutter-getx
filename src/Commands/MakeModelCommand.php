<?php

namespace LaravelFlutterGetx\Commands;

use Symfony\Component\Console\Input\InputOption;

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

        if ($this->option('mock')) {
            $this->call('flutter:make:mock', [
                'name' => $this->getNameInput(),
                '--model' => $this->getNameInput()
            ]);
        }
    }

    protected function replaceWith($stub, $name)
    {
    }

    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/model.stub';
    }

    protected function getOptions()
    {
        return array_merge([
            ['mock', null, InputOption::VALUE_REQUIRED, 'Create mock also.']
        ], parent::getOptions());
    }
}
