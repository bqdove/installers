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
use Notadd\Foundation\Passport\Abstracts\SetHandler;

/**
 * Class DatabaseHandler.
 */
class DatabaseHandler extends SetHandler
{
    /**
     * DatabaseHandler constructor.
     *
     * @param \Illuminate\Container\Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    /**
     * Execute Handler.
     *
     * @return bool
     */
    public function execute()
    {
        return true;
    }
}
