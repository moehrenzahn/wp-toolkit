<?php

namespace Toolkit\Api;

/**
 * Interface ActionInterface
 *
 * @package Toolkit\Api
 */
interface ActionInterface
{
    /**
     * @param array $request
     */
    public function doPostAction(array $request);
}
