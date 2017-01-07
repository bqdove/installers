<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-08-27 17:03
 */
namespace Notadd\Installer\Abstracts;

use Notadd\Installer\Contracts\Prerequisite as PrerequisiteContract;

/**
 * Class Prerequisite.
 */
abstract class Prerequisite implements PrerequisiteContract
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * Checking prerequisite's rules.
     *
     * @return mixed
     */
    abstract public function check();

    /**
     * Get prerequisite's error message.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
