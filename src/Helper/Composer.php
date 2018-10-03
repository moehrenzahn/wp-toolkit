<?php

namespace Toolkit\Helper;

/**
 * Class Composer
 *
 * @package Toolkit\Helper
 */
class Composer
{
    public static function getRootDir()
    {
        $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
        $vendorDir = dirname(dirname($reflection->getFileName()));

        return $vendorDir . '/moehrenzahn/wp-toolkit/src';
    }
}
