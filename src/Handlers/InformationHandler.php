<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-09-11 16:20
 */
namespace Notadd\Installer\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;

/**
 * Class InformationHandler.
 */
class InformationHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->withCode(200)->withData([
            'version' => $this->container->version(),
        ])->withMessage('获取信息成功！');
    }
}
