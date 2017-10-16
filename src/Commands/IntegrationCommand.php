<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-05-11 18:24
 */
namespace Notadd\Installer\Commands;

use Notadd\Foundation\Console\Abstracts\Command;
use Notadd\Foundation\Member\Member;

/**
 * Class IntegrationCommand.
 */
class IntegrationCommand extends Command
{
    /**
     * Configure command.
     */
    protected function configure()
    {
        $this->setDescription('Run notadd\'s integration testing');
        $this->setName('integration');
    }

    /**
     * Command handler.
     */
    public function handle()
    {
        $this->call('migrate', [
            '--force' => true,
        ]);

        $this->call('jwt:generate');

        $this->call('vendor:publish', [
            '--force' => true,
        ]);

        $this->setting->set('application.version', $this->container->version());
        $this->setting->set('site.enabled', true);
        $this->setting->set('site.name', 'Notadd');
        $this->setting->set('setting.image.engine', 'normal');
        $this->setting->set('module.notadd/administration.enabled', true);

        Member::query()->create([
            'name'     => 'admin',
            'email'    => 'admin@notadd.com',
            'password' => bcrypt('123qwe'),
        ]);

        $this->call('key:generate');
        touch($this->container->storagePath() . DIRECTORY_SEPARATOR . 'installed');
        $this->info('Notadd Installed!');
    }
}
