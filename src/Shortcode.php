<?php

namespace Toolkit;

/**
 * Class Shortcode
 *
 * @package Toolkit
 */
class Shortcode
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var \Toolkit\Model\Shortcode[]
     */
    private $models = [];

    /**
     * Shortcode constructor.
     *
     * @param Loader $loader
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $shortcode
     * @param Block $block
     */
    public function add(string $shortcode, Block $block)
    {
        $this->models[] = new \Toolkit\Model\Shortcode($this->loader, $shortcode, $block);
    }

    /**
     * @return \Toolkit\Model\Shortcode[]
     */
    public function getShortcodes(): array
    {
        return $this->models;
    }
}
