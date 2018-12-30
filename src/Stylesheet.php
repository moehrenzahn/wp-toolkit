<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\Model\InlineStyle;

/**
 * Class Stylesheet
 *
 * @package Toolkit
 */
class Stylesheet
{
    /**
     * @var \Moehrenzahn\Toolkit\Model\Stylesheet[]
     */
    private $models = [];

    /**
     * @var Loader
     */
    private $loader;

    /**
     * Stylesheet constructor.
     *
     * @param Loader $loader
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $slug
     * @param string $filePath
     * @param string $version
     */
    public function add(string $slug, string $filePath, string $version = '1.0.0')
    {
        $this->models[$slug] = new \Moehrenzahn\Toolkit\Model\Stylesheet($slug, $filePath, $version);
    }

    /**
     * @param string $css
     */
    public function addInline(string $css)
    {
        $this->models[] = new InlineStyle($this->loader, $css);
    }

    /**
     * @return \Moehrenzahn\Toolkit\Model\Stylesheet[]
     */
    public function getScripts(): array
    {
        return $this->models;
    }
}
