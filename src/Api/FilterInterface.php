<?php

namespace Moehrenzahn\Toolkit\Api;

/**
 * Interface FilterInterface
 *
 * @package Moehrenzahn\Toolkit\Api
 */
interface FilterInterface
{
    /**
     * @param string $content
     * @return string
     */
    public function filter(string $content): string;
}
