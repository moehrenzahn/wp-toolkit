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
     * @var \Toolkit\Model\Shortcode[]
     */
    private $models;

    /**
     * @param string $shortcode
     * @param Block $block
     */
    public function add(string $shortcode, Block $block)
    {
        $this->models[] = new \Toolkit\Model\Shortcode($shortcode, $block);
    }

    /**
     * @return \Toolkit\Model\Shortcode[]
     */
    public function getShortcodes(): array
    {
        return $this->models;
    }
}
