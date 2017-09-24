<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-09-18 20:36
 */
namespace Notadd\Installer\Composer\Installers;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Class ExtensionInstaller.
 */
class AddonInstaller extends LibraryInstaller
{
    /**
     * Get install path for Composer Installer.
     *
     * @param \Composer\Package\PackageInterface $package
     *
     * @return string
     */
    public function getInstallPath(PackageInterface $package)
    {
        list($vendor, $name) = explode('/', $package->getPrettyName());

        return 'extensions/' . $vendor . '/' . $name;
    }

    /**
     * Confirm supported Package Types.
     *
     * @param $packageType
     *
     * @return bool
     */
    public function supports($packageType)
    {
        return $packageType === 'notadd-addon';
    }
}
