<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;

class CreateProjectCommand extends Command
{
    protected $name = 'flutter:create';

    protected $description = 'Create Flutter app.';

    protected $files;

    protected $flutterPath;

    protected $stubPath = __DIR__ . '/../../data/app-stubs/';

    protected $reservedNames = [
        'flutter', 'flutter_app'
    ];

    protected $scaffold = [
        'app/bindings' => 'home_binding.stub',
        'app/controllers' => 'home_controller.stub',
        'app/exceptions' => [
            'bad_request_exception.stub',
            'fetch_data_exception.stub',
            'invalid_input_exception.stub',
            'unauthorised_exception.stub',
        ],
        'app/models' => 'user.stub',
        'app/services' => 'app_service.stub',

        'config' => 'constants.stub',

        'core' => [
            'app_translations.stub',
            'controller_base.stub',
            'exception_base.stub',
            'mock_base.stub',
            'model_base.stub',
            'provider_base.stub',
            'response_api.stub',
            'translation_base.stub',
        ],

        'mocks' => 'user_mock.stub',

        'resources/lang' => 'en.stub',
        'resources/views' => 'home_view.stub',

        'root' => [
            'main.stub',
            'routes.stub',
        ],
    ];

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
        $this->flutterPath = config('ksp-lfg.path', base_path('flutter'));
    }

    public function handle()
    {
        $this->makeDirectory($this->flutterPath);

        $structure = config('ksp-lfg.structure', []);

        $name = $this->getNameInput();
        $path = $this->getPath($name);

        if ($this->isReservedName($name)) {
            $this->error($name . ' is reserved!');

            return false;
        }

        if ($this->files->isDirectory($path) && (!$this->hasOption('force') || !$this->option('force'))) {
            $this->error('Project ' . $name . ' already exists!');

            return false;
        }

        if ($this->files->isDirectory($path)) {
            if (!$this->files->moveDirectory($path, $path . '-BACKUP')) {
                $this->error('Unable to move/rename previous project dir!');
                return false;
            }
        }

        $org = $this->option('org') ?? 'com.example';
        $description = $this->option('description') ?? "An Flutter App";

        $flutterCommand = 'flutter create ' .
            '--org ' . $org .
            ' --description "' . $description . '" ' .
            $this->flutterPath . '/' .
            $this->getFlutteredName($name);

        $this->info('Executing ' . $flutterCommand);
        $shellExce = shell_exec($flutterCommand);

        if (!$this->files->isDirectory($path)) {
            $this->error('Unable to run [' . $flutterCommand . ']');
            $this->line('');
            $this->error($shellExce);
            return false;
        } else {
            $this->updatePubspec($path);
        }

        foreach ($structure as $key => $dir) {
            $this->makeDirectory($path . '/lib/' . $dir);
        }

        $this->info('Structure created successfully!');

        foreach ($this->scaffold as $stubPath => $stub) {
            if (is_array($stub)) {
                foreach ($stub as $stubFile) {
                    $this->generateStubbedFile($stubFile, $stubPath, $name, $path);
                }
            } else {
                $this->generateStubbedFile($stub, $stubPath, $name, $path);
            }
        }

        $this->info($name . ' structured successfully!');

        return true;
    }

    protected function updatePubspec($path)
    {
        $pubspecFile = $path . '/pubspec.yaml';

        $pubspec = Yaml::parse($this->files->get($pubspecFile));

        $this->files->move($pubspecFile, $path . '/pubspec.yaml.backup');

        $currentDeps = $pubspec['dependencies'];
        $pubspec['dependencies'] = array_merge([
            'get' => '^4.1.4',
            //'flutter_svg' => '^0.22.0',
            'get_storage' => '^2.0.2',
        ], $currentDeps);

        if ($this->option('null-safety')) {
            $pubspec['environment']['sdk'] = '>=2.12.0 <3.0.0';
        }

        $newPubspec = Yaml::dump($pubspec, 5, 2);

        $this->files->put($pubspecFile, $newPubspec);

        $this->info('pubspec.yaml updated!');
    }

    protected function generateStubbedFile($stub, $subPath, $name, $path)
    {
        $dartFile = str_replace('.stub', '.dart', $stub);

        $subDir = explode('/', $subPath)[1] ?? $subPath;

        if ($subPath === 'root') {
            $newPath = $path . '/lib/' . $dartFile;
            $stubFile = $this->stubPath . $stub;
        } else {
            $subPath = $structure[$subDir] ?? $subPath;
            $newPath = $path . '/lib/' . $subPath . '/' . $dartFile;
            $stubFile = $this->stubPath . $subPath . '/' . $stub;
        }

        $this->files->put($newPath, $this->getContent($stubFile, $name));
    }

    protected function getContent($stubFile, $name)
    {
        $content = $this->files->get($stubFile);

        return $this->replaceAppName($content, $this->getFlutteredName($name));
    }


    protected function replaceAppName($stub, $name)
    {
        return str_replace('{{APP_NAME}}', $name, $stub);
    }

    protected function isReservedName($name)
    {
        return in_array($this->getFlutteredName($name), $this->reservedNames);
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    protected function getPath($name = null)
    {
        if ($name) {
            return $this->flutterPath . '/' . $this->getFlutteredName($name);
        }

        return $this->flutterPath;
    }

    protected function getFlutteredName($name)
    {
        return Str::slug($name, '_');
    }

    protected function getNameInput()
    {
        return $this->argument('name');
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The names of flutter project will be created.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['org', null, InputOption::VALUE_OPTIONAL, 'Oragnization aka com.example'],
            ['description', null, InputOption::VALUE_OPTIONAL, 'Description of your project!'],
            ['null-safety', null, InputOption::VALUE_NONE, 'Null-Safety enabled.'],
            ['demo', null, InputOption::VALUE_NONE, 'Scaffold with demo structure.'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the project already exists.'],
        ];
    }
}
