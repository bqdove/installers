<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-04-09 11:41
 */
namespace Notadd\Installer\Handlers;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
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
     * @param \Illuminate\Container\Container         $container
     * @param \Illuminate\Contracts\Config\Repository $repository
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
            'fetch'       => PDO::FETCH_CLASS,
            'default'     => $this->request->input('database_engine'),
            'connections' => [],
            'redis'       => [],
        ]);
        $sql = '';
        switch ($this->request->input('database_engine')) {
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
                    'port'      => $this->request->input('database_port') ?: 3306,
                    'strict'    => true,
                    'engine'    => null,
                ]);
                $sql = 'show tables';
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
                    'port'     => $this->request->input('database_port') ?: 5432,
                    'schema'   => 'public',
                ]);
                $sql = "select * from pg_tables where schemaname='public'";
                break;
        }
        try {
            $results = collect($this->container->make('db')->select($sql));
            if ($results->count()) {
                $this->code = 500;
                $this->errors->push('数据库[' . $this->request->input('database_name') . ']已经存在数据表，请先清空数据库！');
                return false;
            }
        } catch (Exception $exception) {
            $this->code = 500;
            $this->data = $exception->getTrace();
            switch ($exception->getCode()) {
                case 7:
                    $this->errors->push('数据库账号或密码错误，或数据库不存在！');
                    break;
                case 1045:
                    $this->errors->push('数据库账号或密码错误！');
                    break;
                case 1049:
                    $this->errors->push('数据库[' . $this->request->input('database_name') . ']不存在，请先创建数据库！');
                    break;
                default:
                    $this->errors->push($exception->getCode());
                    $this->errors->push($exception->getMessage());
                    break;
            }

            return false;
        }

        return true;
    }
}
