<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-03-03 16:26
 */
namespace Notadd\Installer\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\Installer\Contracts\Prerequisite;

/**
 * Class CheckingHandler.
 */
class CheckHandler extends Handler
{
    /**
     * @var \Notadd\Installer\Contracts\Prerequisite
     */
    protected $prerequisite;

    /**
     * CheckingHandler constructor.
     *
     * @param \Illuminate\Container\Container          $container
     * @param \Notadd\Installer\Contracts\Prerequisite $prerequisite
     */
    public function __construct(Container $container, Prerequisite $prerequisite)
    {
        parent::__construct($container);
        $this->prerequisite = $prerequisite;
    }

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        if ($this->container->isInstalled()) {
            $this->withCode(500)->withError('Notadd 已经安装，无需重复安装！');
        } else {
            $this->prerequisite->check();
            $this->withCode(200)->withData($this->prerequisite->getMessages())->withMessage('获取预安装检测信息成功！');
        }
    }
}
