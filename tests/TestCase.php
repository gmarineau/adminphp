<?php

namespace Gmarineau\AdminPhp\Tests;

use Gmarineau\AdminPhp\AdminPhpServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [AdminPhpServiceProvider::class];
    }
}
