<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-03-03 16:26
 */
namespace Notadd\Installer\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Passport\Abstracts\DataHandler;
use Notadd\Installer\Contracts\Prerequisite;

/**
 * Class CheckingHandler.
 */
class CheckHandler extends DataHandler
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
     * Http code.
     *
     * @return int
     */
    public function code()
    {
        return 200;
    }

    /**
     * Errors for handler.
     *
     * @return array
     */
    public function errors()
    {
        return [
            $this->translator->trans(''),
        ];
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
        $this->prerequisite->check();
        return $this->prerequisite->getMessages();
    }

    /**
     * Messages for handler.
     *
     * @return array
     */
    public function messages()
    {
        return [
            $this->translator->trans(''),
        ];
    }
}
