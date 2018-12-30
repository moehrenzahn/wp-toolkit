<?php

namespace Moehrenzahn\Toolkit\Api;

/**
 * Interface ActionInterface
 *
 * This Interface can be implemented to specify actions for POST and AJAX requests.
 * Use with Moehrenzahn\Toolkit\AjaxAction or Moehrenzahn\Toolkit\PostAction.
 *
 * @package Moehrenzahn\Toolkit\Api
 */
interface ActionInterface
{
    /**
     * @param mixed[] $request
     */
    public function doAction(array $request);
}
