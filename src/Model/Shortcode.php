<?php

namespace Toolkit\Model;

use Toolkit\Block;
use Toolkit\Loader;

/**
 * Generic ShortCode Class
 *
 * @package Toolkit\Model
 */
class Shortcode
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var string
     */
    private $shortCode;

    /**
     * @var Block
     */
    private $block;

    /**
     * Shortcode constructor.
     *
     * @param Loader $loader
     * @param string $shortCode
     * @param Block $block
     */
    public function __construct(Loader $loader, string $shortCode, Block $block)
    {
        $this->loader = $loader;
        $this->shortCode = $shortCode;
        $this->block = $block;
        $this->loader->addShortcode($this->shortCode, $this, 'getShortcodeContent');
    }

    /**
     * @param mixed[] $attributes
     * @param string $content
     * @param string $shortcodeTag
     * @return string
     */
    public function getShortcodeContent($attributes, $content, $shortcodeTag)
    {
        $this->block->setData([
            'attributes' => $attributes,
            'content' => $content,
            'shortcodeTag' => $shortcodeTag,
        ]);

        return $this->block->getHtml();
    }
}
