<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-04-09 11:41
 */
namespace Notadd\Installer\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Configuration\Repository;
use Notadd\Foundation\Passport\Abstracts\SetHandler;
use PDO;

/**
 * Class DatabaseHandler.
 */
class DatabaseHandler extends SetHandler
{
    /**
     * @var \Notadd\Foundation\Configuration\Repository
     */
    protected $repository;

    /**
     * DatabaseHandler constructor.
     *
     * @param \Illuminate\Container\Container             $container
     * @param \Notadd\Foundation\Configuration\Repository $repository
     */
    public function __construct(Container $container, Repository $repository)
    {
        parent::__construct($container);
        $this->repository = $repository;
    }

    /**
     * Execute Handler.
     *
     * @return bool
     */
    public function execute()
    {
        if ($this->request->input('database_engine') == 'sqlite') {
            return true;
        }
        $this->repository->set('database', [
            'fetch'       => PDO::FETCH_OBJ,
            'default'     => $this->request->input('database_engine'),
            'connections' => [],
            'redis'       => [],
        ]);
        switch ($this->request->input('driver')) {
            case 'mysql':
                $this->repository->set('database.connections.mysql', [
                    'driver'    => 'mysql',
                    'host'      => $this->request->input('database_host'),
                    'database'  => $this->request->input('database_name'),
                    'username'  => $this->request->input('database_username'),
                    'password'  => $this->request->input('database_password'),
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => $this->request->input('database_prefix'),
                    'port'   => $this->request->input('database_port') ?: 3306,
                    'strict'    => true,
                    'engine'    => null,
                ]);
                break;
            case 'pgsql':
                $this->repository->set('database.connections.pgsql', [
                    'driver'   => 'pgsql',
                    'host'     => $this->request->input('database_host'),
                    'database' => $this->request->input('database_name'),
                    'username' => $this->request->input('database_username'),
                    'password' => $this->request->input('database_password'),
                    'charset'  => 'utf8',
                    'prefix'   => $this->request->input('database_prefix'),
                    'port'   => $this->request->input('database_port') ?: 5432,
                    'schema'   => 'public',
                    'sslmode'  => 'prefer',
                ]);
                break;
        }
        return true;
    }
}
