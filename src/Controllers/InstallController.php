<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-08-27 18:36
 */
namespace Notadd\Installer\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\Installer\Contracts\Prerequisite;
use Notadd\Installer\Requests\InstallRequest;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class InstallController.
 */
class InstallController extends Controller
{
    /**
     * @var \Notadd\Installer\Commands\InstallCommand
     */
    protected $command;

    /**
     * @var \Notadd\Installer\Contracts\Prerequisite
     */
    protected $prerequisite;

    /**
     * InstallController constructor.
     *
     * @param \Notadd\Installer\Contracts\Prerequisite $prerequisite
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(Prerequisite $prerequisite)
    {
        parent::__construct();
        $this->prerequisite = $prerequisite;
    }

    /**
     * Index handler.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->view('install::install');
    }

    /**
     * Store handler.
     *
     * @param \Notadd\Installer\Requests\InstallRequest $request
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(InstallRequest $request)
    {
        $this->command = $this->getCommand('install');
        $this->command->setDataFromController($request->all());
        $input = new ArrayInput([]);
        $output = new BufferedOutput();
        $this->command->run($input, $output);
        $this->share('admin_account', $request->get('admin_account'));
        $this->share('admin_email', $request->get('admin_email'));
        $this->share('admin_password', $request->get('admin_password'));

        return $this->view('install::success');
    }
}
