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
        return dirname(\Composer\Factory::getComposerFile());
    }
}