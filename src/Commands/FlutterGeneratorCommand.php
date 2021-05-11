<?php

namespace KSPEdu\LaravelFlutterGetx\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

abstract class FlutterGeneratorCommand extends Command
{
    protected $name;
    protected $files;
    protected $config;

    protected $stubPath = '/../../data/stubs';

    protected $reservedNames = [
        'flutter'
    ];

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->config = config('ksp-lfg');
    }

    public function handle()
    {
        if (!$this->files->exists($this->getPath())) {
            $this->error('The "' . ($this->config['app_name'] ?? 'Flutter') . '" App is not exists.');

            return false;
        }

        if ($this->isReservedName($this->getNameInput())) {
            $this->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

            return false;
        }

        $name = $this->getNameInput();

        $path = $this->getPath($name);
        $dartFile = $path . '/' . Str::slug($name, '_') . ($this->type === 'Model' ? '' : '_' . Str::lower($this->type)) . '.dart';

        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($dartFile)
        ) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($dartFile, $this->buildClass($name));

        $this->info($this->type . ' created successfully.');
    }

    protected function alreadyExists($file)
    {
        return $this->files->exists($file);
    }

    protected function getPath($name = null)
    {
        $path = $this->config['path'] . '/' . $this->getProjectInput();

        if ($name) {
            return $path . '/lib/' . $this->config['structure'][Str::plural(Str::lower($this->type))];
        }

        return $path;
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceAppName($stub)->replaceClass($stub, $name)->replaceWith($stub, $name);
    }

    protected function replaceAppName(&$stub)
    {
        $stub = str_replace('{{APP_NAME}}', $this->getProjectInput(), $stub);

        return $this;
    }

    protected function replaceClass(&$stub, $name)
    {
        $stub = str_replace('{{NAME}}', Str::title($name), $stub);

        return $this;
    }

    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }

    protected function getProjectInput()
    {
        return Str::slug(trim($this->argument('project')), '_');
    }

    protected function isReservedName($name)
    {
        $name = strtolower($name);

        return in_array($name, $this->reservedNames);
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if already exists'],
        ];
    }

    protected function getArguments()
    {
        return [
            ['project', InputArgument::REQUIRED, 'The project'],
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    abstract protected function getStub();

    abstract protected function replaceWith($stub, $name);
}
