<?php

namespace Toolkit\Api;

/**
 * Interface ActionInterface
 *
 * This Interface can be implemented to specify actions for POST and AJAX requests.
 * Use with Toolkit\AjaxAction or Toolkit\PostAction.
 *
 * @package Toolkit\Api
 */
interface ActionInterface
{
    /**
     * @param mixed[] $request
     */
    public function doAction(array $request);
}
