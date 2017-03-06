<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-03-06 17:34
 */
namespace Notadd\Installer\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Passport\Abstracts\SetHandler;

/**
 * Class InstallHandler.
 */
class InstallHandler extends SetHandler
{
    /**
     * InstallHandler constructor.
     *
     * @param \Illuminate\Container\Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
        return $this->request->all();
        return [];
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
     * Execute Handler.
     *
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute()
    {
        $this->validate($this->request, [
            'account_mail' => 'required',
            'account_password' => 'required',
            'account_username' => 'required',
            'database_engine' => 'required',
            'database_host' => 'required',
            'database_name' => 'required',
            'database_password' => 'required',
            'database_username' => 'required',
            'sitename' => 'required',
        ], [
            'account_mail.required' => '必须填写管理员邮箱',
            'account_password.required' => '必须填写管理员账户',
            'account_username.required' => '必须填写管理员密码',
            'database_engine.required' => '必须选择数据库引擎',
            'database_host.required' => '必须填写数据库地址',
            'database_name.required' => '必须填写数据库名称',
            'database_password.required' => '必须填写数据库密码',
            'database_username.required' => '必须填写数据库用户名',
            'sitename.required' => '必须填写网站名称',
        ]);
        return true;
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
