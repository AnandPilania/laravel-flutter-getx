<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

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

        if ($this->option('model')) {
            $this->call('flutter:make:model', [
                'name' => $this->option('model')
            ]);
        }
    }

    protected function replaceWith($stub, $name)
    {
        if ($modelName = $this->option('model')) {
            $modelDartName = $this->flutteredName($modelName);
            $modelClassName = Str::title($modelName);

            return str_replace('{{MODEL}}', $modelClassName, str_replace('{{SMODEL}}', $modelDartName, $stub));
        }
        return $stub;
    }

    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/mock' . ($this->option('model') ? '.model' : '') . '.stub';
    }

    protected function getOptions()
    {
        return array_merge([
            ['model', null, InputOption::VALUE_REQUIRED, 'Create mock scaffold with model.']
        ], parent::getOptions());
    }
}
