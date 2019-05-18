<?php

namespace Moehrenzahn\Toolkit\Model;

use Moehrenzahn\Toolkit\Api\ViewInterface;
use Moehrenzahn\Toolkit\Loader;

/**
 * Generic ShortCode Class
 *
 * @package Moehrenzahn\Toolkit\Model
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
     * @var ViewInterface
     */
    private $view;

    /**
     * Shortcode constructor.
     *
     * @param Loader $loader
     * @param string $shortCode
     * @param ViewInterface $view
     */
    public function __construct(Loader $loader, string $shortCode, ViewInterface $view)
    {
        $this->loader = $loader;
        $this->shortCode = $shortCode;
        $this->view = $view;
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
        $this->view->setData([
            'attributes' => $attributes,
            'content' => $content,
            'shortcodeTag' => $shortcodeTag,
        ]);

        return $this->view->getHtml();
    }
}
