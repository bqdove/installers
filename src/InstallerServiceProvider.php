<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-10-24 10:49
 */
namespace Notadd\Installer;

use Illuminate\Support\ServiceProvider;
use Notadd\Installer\Commands\InstallCommand;
use Notadd\Installer\Contracts\Prerequisite;
use Notadd\Installer\Controllers\InstallController;
use Notadd\Installer\Prerequisite\PhpExtension;
use Notadd\Installer\Prerequisite\PhpVersion;
use Notadd\Installer\Prerequisite\WritablePath;

/**
 * Class InstallServiceProvider.
 */
class InstallerServiceProvider extends ServiceProvider
{
    /**
     * Boot service provider.
     */
    public function boot()
    {
        if (!$this->app->isInstalled()) {
            $this->app->make('router')->resource('/', InstallController::class);
        }
        $this->commands([
            InstallCommand::class,
        ]);
        $this->loadViewsFrom(realpath(__DIR__ . '/../resources/views'), 'install');
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'install');
    }

    /**
     * Register for service provider.
     */
    public function register()
    {
        $this->app->bind(Prerequisite::class, function () {
            return new Composite(new PhpVersion('5.6.28'), new PhpExtension([
                'dom',
                'fileinfo',
                'gd',
                'json',
                'mbstring',
                'openssl',
                'pdo_mysql',
            ]), new WritablePath([
                public_path(),
                storage_path(),
            ]));
        });
    }
}
