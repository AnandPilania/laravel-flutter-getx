<?php

namespace LaravelFlutterGetx\Commands;

use Illuminate\Support\Str;

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

        $name = $this->getNameInput();
        $lName = $this->getFlutteredName($name);
        $tName = Str::title($name);

        $info = 'Add [';
        $info .= "'{$lName}': {$tName}.translations()";
        $info .= '] to [AppTranslations] file.';

        $this->info($info);
    }

    protected function replaceWith($stub, $name)
    {
    }

    protected function getStub()
    {
        return __DIR__ . $this->stubPath . '/lang.stub';
    }
}
