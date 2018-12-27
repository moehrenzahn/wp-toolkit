<?php

namespace Toolkit\Api;

/**
 * Interface FilterInterface
 *
 * @package Toolkit\Api
 */
interface FilterInterface
{
    /**
     * @param string $content
     * @return string
     */
    public function filter(string $content): string;
}
