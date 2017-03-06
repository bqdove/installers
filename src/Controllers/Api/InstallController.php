<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-03-03 16:25
 */
namespace Notadd\Installer\Controllers\Api;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\Installer\Handlers\CheckHandler;

/**
 * Class InstallController.
 */
class InstallController extends Controller
{
    /**
     * Checking handler.
     *
     * @param \Notadd\Installer\Handlers\CheckHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function check(CheckHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
