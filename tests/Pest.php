<?php

use Gmarineau\AdminPhp\Tests\Console\InstallCommandTestCase;
use Gmarineau\AdminPhp\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class)->in('Feature');
uses(InstallCommandTestCase::class)->in('Console');
