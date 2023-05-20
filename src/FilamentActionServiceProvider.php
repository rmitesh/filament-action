<?php

namespace Rmitesh\FilamentAction;

use Illuminate\Support\ServiceProvider;
use Rmitesh\FilamentAction\Console\Commands\MakeFilamentAction;

class FilamentActionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeFilamentAction::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
