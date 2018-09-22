<?php

namespace Toolkit;

/**
 * Class AbstractTheme
 *
 * @package Toolkit
 */
class AbstractTheme extends AbstractExtension
{
    /**
     * @var ImageSize
     */
    protected $imageSize;

    /**
     * AbstractTheme constructor.
     */
    public function __construct()
    {
        $this->imageSize = new ImageSize();

        parent::__construct();
    }
}
