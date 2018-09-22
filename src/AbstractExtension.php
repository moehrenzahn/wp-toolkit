<?php

namespace Toolkit;

use Toolkit\Loader;

/**
 * Class AbstractExtension
 *
 * @package Toolkit
 */
class AbstractExtension
{
    /**
     * @var Loader
     */
    protected $loader;

    /**
     * @var Javascript
     */
    protected $javascript;

    /**
     * @var Stylesheet
     */
    protected $stylesheet;

    /**
     * @var Shortcode
     */
    protected $shortcode;

    /**
     * AbstractExtension constructor.
     */
    public function __construct()
    {
        $this->loader = new Loader();
        $this->javascript = new Javascript();
        $this->stylesheet = new Stylesheet();
        $this->shortcode = new Shortcode();
    }
}
