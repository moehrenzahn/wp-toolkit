<?php

namespace Moehrenzahn\Toolkit\Helper;

/**
 * Class Request
 *
 * @package Moehrenzahn\Toolkit\Helper
 */
class Request
{
    /**
     * @return bool
     */
    public static function isAjax(): bool
    {
        return defined('DOING_AJAX') && DOING_AJAX;
    }

    /**
     * @return bool
     */
    public static function isAutosave(): bool
    {
        return defined('DOING_AUTOSAVE') && DOING_AUTOSAVE;
    }
}
