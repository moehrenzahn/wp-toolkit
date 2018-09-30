<?php

namespace Toolkit;

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
        if (is_null($value)) {
            $value = $this->getDefaultValue($key);
        }

        return $value;
    }

    /**
     * @TODO
     *
     * @param string $key
     * @return bool
     */
    private function getDefaultValue($key)
    {
        return false;
    }
}
