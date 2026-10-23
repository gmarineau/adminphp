<?php

use Illuminate\Support\Facades\File;

it('publishes the config, the timestamped migrations and the admin assets', function () {
    $this->artisan('adminphp:install')
        ->expectsConfirmation('Run the database migrations now?', 'no')
        ->assertSuccessful();

    expect(config_path('adminphp.php'))->toBeFile()
        ->and(File::glob(database_path('migrations/*_create_adminphp_blocks_table.php')))->toHaveCount(1)
        ->and(public_path('vendor/adminphp/.vite/manifest.json'))->toBeFile();
});

it('can be run again without duplicating migrations or overwriting the config', function () {
    $this->artisan('adminphp:install')->expectsConfirmation('Run the database migrations now?', 'no');

    File::put(config_path('adminphp.php'), '<?php return ["customized" => true];');

    $this->artisan('adminphp:install')
        ->expectsOutputToContain('ALREADY PUBLISHED')
        ->expectsConfirmation('Run the database migrations now?', 'no')
        ->assertSuccessful();

    expect(File::glob(database_path('migrations/*_create_adminphp_blocks_table.php')))->toHaveCount(1)
        ->and(File::get(config_path('adminphp.php')))->toContain('customized');
});

it('overwrites the config with --force', function () {
    File::put(config_path('adminphp.php'), '<?php return ["customized" => true];');

    $this->artisan('adminphp:install', ['--force' => true])
        ->expectsConfirmation('Run the database migrations now?', 'no')
        ->assertSuccessful();

    expect(File::get(config_path('adminphp.php')))->toContain("'table_prefix'");
});
