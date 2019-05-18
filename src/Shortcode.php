<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\Api\ViewInterface;

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
     * @var \Moehrenzahn\Toolkit\Model\Shortcode[]
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
     * @param ViewInterface $view
     */
    public function add(string $shortcode, ViewInterface $view)
    {
        $this->models[] = new \Moehrenzahn\Toolkit\Model\Shortcode($this->loader, $shortcode, $view);
    }

    /**
     * @return \Moehrenzahn\Toolkit\Model\Shortcode[]
     */
    public function getShortcodes(): array
    {
        return $this->models;
    }
}
