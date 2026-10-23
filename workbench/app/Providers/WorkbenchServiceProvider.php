<?php

namespace Workbench\App\Providers;

use Gmarineau\AdminPhp\AdminPhp;
use Gmarineau\AdminPhp\Tests\Fixtures\ArticleModule;
use Illuminate\Support\ServiceProvider;

/**
 * Registers demo modules in the local Testbench app used to develop the admin.
 */
class WorkbenchServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(AdminPhp::class)->registerModules([ArticleModule::class]);
    }
}
