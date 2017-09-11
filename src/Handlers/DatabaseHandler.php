<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-04-09 11:41
 */
namespace Notadd\Installer\Handlers;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Notadd\Foundation\Routing\Abstracts\Handler;
use PDO;

/**
 * Class DatabaseHandler.
 */
class DatabaseHandler extends Handler
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
     */
    public function execute()
    {
        if ($this->container->isInstalled()) {
            $this->withCode(500)->withError('Notadd 已经安装，无需重复安装！');
        } else {
            if ($this->request->input('database_engine') == 'sqlite') {
                $this->withCode(200)->withMessage('SQLite 无需检测！');
            } else {
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
                $this->repository->set('database.redis.default', [
                    'host'     => $this->request->input('redis_host', 'localhost'),
                    'password' => $this->request->input('redis_password') ?: null,
                    'port'     => $this->request->input('redis_port', 6379),
                    'database' => 0,
                ]);
                try {
                    $this->container->make('redis')->connect();
                    $results = collect($this->container->make('db')->select($sql));
                    if ($results->count()) {
                        $this->withCode(500)->withError('数据库[' . $this->request->input('database_name') . ']已经存在数据表，请先清空数据库！');
                    } else {
                        $this->withCode(200)->withMessage('');
                    }
                } catch (Exception $exception) {
                    switch ($exception->getCode()) {
                        case 0:
                            $error = 'Redis 密码未设置或密码错误！';
                            break;
                        case 7:
                            $error = '数据库账号或密码错误，或数据库不存在！';
                            break;
                        case 99:
                            $error = 'Redis 地址不可访问！';
                            break;
                        case 111:
                            $error = 'Redis 配置错误！';
                            break;
                        case 1045:
                            $error = '数据库账号或密码错误！';
                            break;
                        case 1049:
                            $error = '数据库[' . $this->request->input('database_name') . ']不存在，请先创建数据库！';
                            break;
                        default:
                            $error = array_merge((array)$exception->getCode(), (array)$exception->getMessage());
                            break;
                    }
                    $this->withCode(500)->withData($exception->getTrace())->withError($error);
                }
            }
        }
    }
}
