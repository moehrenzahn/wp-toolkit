<?php

namespace Toolkit;

use Toolkit\Loader;

/**
 * Class InlineStyle
 *
 * @package Toolkit
 */
class InlineStyle
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var string
     */
    private $css;

    /**
     * InlineStyle constructor.
     *
     * @param Loader $loader
     * @param string $css
     */
    public function __construct(Loader $loader, string $css)
    {
        $this->loader = $loader;
        $this->css = $css;

        $this->loader->addAction('wp_enqueue_scripts', $this, 'enqueueStyle');
    }


    public function enqueueStyle()
    {
        $dummyHandle = '___aaa-wordpress-dummy-handle';
        wp_register_style($dummyHandle, false);
        wp_enqueue_style($dummyHandle);
        wp_add_inline_style($dummyHandle, $this->css);
    }
}
