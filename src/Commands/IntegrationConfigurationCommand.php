<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-05-11 18:38
 */
namespace Notadd\Installer\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Notadd\Foundation\Console\Abstracts\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Yaml\Yaml;

/**
 * Class IntegrationConfigurationCommand.
 */
class IntegrationConfigurationCommand extends Command
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * IntegrationConfigurationCommand constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function configure()
    {
        $this->addArgument('drive', InputArgument::REQUIRED, 'Database drive, such as mysql, pgsql, sqlite.');
        $this->addArgument('host', InputArgument::REQUIRED, 'Database host.');
        $this->addArgument('port', InputArgument::REQUIRED, 'Database port.');
        $this->addArgument('database', InputArgument::REQUIRED, 'Database name.');
        $this->addArgument('username', InputArgument::REQUIRED, 'Database username.');
        $this->addArgument('password', InputArgument::REQUIRED, 'Database password.');
        $this->addArgument('prefix', InputArgument::REQUIRED, 'Database prefix.');
        $this->setName('integration:configuration');
    }

    public function fire()
    {
        $file = $this->container->environmentFilePath();
        $this->files->exists($file) || touch($file);
        $database = new Collection($this->container->make(Yaml::class)->parse(file_get_contents($file)));
        $database->put('DB_CONNECTION', $this->input->getArgument('driver'));
        $database->put('DB_HOST', $this->input->getArgument('database_host'));
        $database->put('DB_PORT', $this->input->getArgument('database_port'));
        $database->put('DB_DATABASE', $this->input->getArgument('driver') == 'sqlite' ? $this->container->storagePath() . DIRECTORY_SEPARATOR . 'bootstraps' . DIRECTORY_SEPARATOR . 'database.sqlite' : $this->input->getArgument('database'));
        $database->put('DB_USERNAME', $this->input->getArgument('database_username'));
        $database->put('DB_PASSWORD', $this->input->getArgument('database_password'));
        $database->put('DB_PREFIX', $this->input->getArgument('database_prefix'));

        file_put_contents($file, $this->container->make(Yaml::class)->dump($database->toArray()));
    }
}
