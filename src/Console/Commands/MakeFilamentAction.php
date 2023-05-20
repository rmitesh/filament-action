<?php

namespace Rmitesh\FilamentAction\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Rmitesh\FilamentAction\Support\Commands\Concerns\CanManipulateFiles;
use Rmitesh\FilamentAction\Support\Commands\Concerns\CanValidateInput;

class MakeFilamentAction extends Command
{
    use CanValidateInput;
    use CanManipulateFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        make:filament-action {resource?} {name?}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a Filament table action.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $resourcePath = config('filament.resources.path', app_path('Filament/Resources/'));
        $resourceNamespace = config('filament.resources.namespace', 'App\\Filament\\Resources');

        // Resouce Name
        $resource = (string) Str::of($this->argument('resource') ?? $this->askRequired('Resource (e.g. `DepartmentResource`)', 'resource'))
            ->studly()
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');

        if (! Str::of($resource)->endsWith('Resource')) {
            $resource .= 'Resource';
        }

        // Action name
        $name = (string) Str::of($this->argument('name') ?? $this->askRequired('Action Name (e.g. `Comment`)', 'name'))
            ->studly()
            ->trim(' ');

        $className = (string) Str::of($name)
            ->studly()
            ->append('Action');

        $path = (string) Str::of($className)
            ->prepend("{$resourcePath}/{$resource}/Actions/")
            ->replace('\\', '/')
            ->append('.php');

        if ($this->checkForCollision([ $path ])) {
            return static::INVALID;
        }

        $this->copyStubToApp('Action', $path, [
            'namespace' => "{$resourceNamespace}\\{$resource}\\Actions",
            'className' => $className,
            'name' => $name,
            'label' => Str::lower($name),
        ]);

        $this->info("Successfully created {$className}!");

        $this->info("Make sure to register the action in `{$resource}::table()->actions()`.");
        return static::SUCCESS;
    }
}
