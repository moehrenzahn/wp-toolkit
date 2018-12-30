<?php

namespace Moehrenzahn\Toolkit;

/**
 * Class ConfigAccessor
 *
 * @package Toolkit
 */
class ConfigAccessor
{
    /**
     * @param string $key
     * @return mixed
     */
    public function getConfigValue(string $key)
    {
        $value = get_option($key, null);

        return $value;
    }
}
