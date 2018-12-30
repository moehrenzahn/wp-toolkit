<?php

namespace Moehrenzahn\Toolkit\Helper;

/**
 * Class Browser
 *
 * @package Moehrenzahn\Toolkit\Helper
 */
class Browser
{
    /**
     * Detect wheter client is using internet explorer.
     *
     * @url https://wp-mix.com/php-detect-all-versions-ie/
     *
     * @return bool
     */
    public static function isInternetExplorer()
    {
        $userAgent = htmlentities(
            $_SERVER['HTTP_USER_AGENT'],
            ENT_QUOTES,
            'UTF-8'
        );

        return preg_match('~MSIE|Internet Explorer~i', $userAgent)
            || strpos($userAgent, 'Trident/7.0; rv:11.0') !== false;
    }
}
