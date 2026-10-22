<?php

namespace Gmarineau\AdminPhp;

use Illuminate\Support\ServiceProvider;

class AdminPhpServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/adminphp.php', 'adminphp');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/adminphp.php' => config_path('adminphp.php'),
            ], 'adminphp-config');
        }
    }
}
