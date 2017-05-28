<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-03-06 17:34
 */
namespace Notadd\Installer\Handlers;

use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Notadd\Foundation\Passport\Abstracts\SetHandler;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class InstallHandler.
 */
class InstallHandler extends SetHandler
{
    /**
     * @var string
     */
    protected $error = '';

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
     * @return array|string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function data()
    {
        if ($this->error) {
            return $this->error;
        } else {
            return [
                'all' => $this->request->all(),
                'administration' => url('admin'),
                'frontend' => url(''),
            ];
        }
    }

    /**
     * Errors for handler.
     *
     * @return array
     */
    public function errors()
    {
        return [
            $this->translator->trans('install::install.fail'),
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
        try {
            if ($this->request->input('database_engine') === 'sqlite') {
                $this->validate($this->request, [
                    'account_mail' => 'required',
                    'account_password' => 'required',
                    'account_username' => 'required',
                    'database_engine' => 'required',
                    'sitename' => 'required',
                ], [
                    'account_mail.required' => '必须填写管理员邮箱',
                    'account_password.required' => '必须填写管理员账户',
                    'account_username.required' => '必须填写管理员密码',
                    'database_engine.required' => '必须选择数据库引擎',
                    'sitename.required' => '必须填写网站名称',
                ]);
            } else {
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
            }
            $command = $this->getCommand('install');
            $command->setDataFromController($this->request->all());
            $input = new ArrayInput([]);
            $output = new BufferedOutput();
            $command->run($input, $output);
        } catch (\Exception $exception) {
            $this->code = $exception->getCode();
            $this->error = [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTrace(),
            ];
        }
        return true;
    }

    /**
     * Get a command from console instance.
     *
     * @param string $name
     *
     * @return \Notadd\Foundation\Console\Abstracts\Command|\Symfony\Component\Console\Command\Command
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getCommand($name)
    {
        return $this->getConsole()->get($name);
    }

    /**
     * Get console instance.
     *
     * @return \Illuminate\Contracts\Console\Kernel|\Notadd\Foundation\Console\Application
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getConsole()
    {
        $kernel = $this->container->make(Kernel::class);
        $kernel->bootstrap();

        return $kernel->getArtisan();
    }

    /**
     * Messages for handler.
     *
     * @return array
     */
    public function messages()
    {
        return [
            $this->translator->trans('install::install.success'),
        ];
    }
}
