<?php
namespace Toolkit;

/**
 * Class ConfigAccessor
 *
 * @package Toolkit
 */
class ConfigAccessor
{
    const CONFIG_PREFIX = 'eule_';

    /**
     * @param string $key
     * @return mixed|false
     */
    public function getConfigValue(string $key)
    {
        if (substr($key, 0, strlen(self::CONFIG_PREFIX)) !== self::CONFIG_PREFIX) {
            $key = self::CONFIG_PREFIX . $key;
        }
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
