<?php

namespace Toolkit\Model;

use Toolkit\Block;

/**
 * Generic ShortCode Class
 *
 * @package Toolkit\Model
 */
class Shortcode
{
    /**
     * @var string
     */
    private $shortCode;

    /**
     * @var Block
     */
    private $block;

    /**
     * ShortCode constructor.
     *
     * @param $shortCode
     * @param Block $block
     */
    public function __construct(string $shortCode, Block $block)
    {
        $this->shortCode = $shortCode;
        $this->block = $block;
        add_shortcode($this->shortCode, [$this->block, 'getHtml']);
    }
}
