<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-08-27 19:29
 */
namespace Notadd\Installer\Prerequisite;

use Notadd\Installer\Abstracts\Prerequisite;

/**
 * Class PhpExtension.
 */
class PhpExtension extends Prerequisite
{
    /**
     * @var array
     */
    protected $extensions;

    /**
     * PhpExtension constructor.
     *
     * @param array $extensions
     */
    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
    }

    /**
     * Checking prerequisite's rules.
     */
    public function check()
    {
        foreach ($this->extensions as $extension) {
            if (!extension_loaded($extension)) {
                $this->messages[] = [
                    'type' => 'error',
                    'detail' => '',
                    'help' => '',
                    'message' => "必须安装 PHP 扩展 '{$extension}'！",
                ];
            } else {
                $this->messages[] = [
                    'type' => 'message',
                    'message' => "PHP 扩展 '{$extension}' 已经安装。",
                ];
            }
        }
    }
}
