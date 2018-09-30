<?php

namespace Toolkit;

/**
 * Class PostMetaBox
 *
 * @package Toolkit\PostMetaBox
 */
class PostMetaBox
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var Javascript
     */
    private $javascript;

    /**
     * @var ImageSize
     */
    private $imageSize;

    /**
     * @var \Toolkit\Model\PostMetaBox[]
     */
    private $metaBoxes = [];

    /**
     * PostMetaBox constructor.
     *
     * @param Loader $loader
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     */
    public function __construct(Loader $loader, Javascript $javascript, ImageSize $imageSize)
    {
        $this->loader = $loader;
        $this->javascript = $javascript;
        $this->imageSize = $imageSize;
    }

    /**
     * @param string $title
     * @param string $templatePath
     * @param string $templateType
     */
    public function add(string $title, string $templatePath, string $templateType = 'phtml')
    {
        $block = new Block($this->javascript, $this->imageSize, $templatePath, $templateType);
        $this->metaBoxes[$title] = new \Toolkit\Model\PostMetaBox($title, $block, $this->loader);
    }

    /**
     * @return Model\PostMetaBox[]
     */
    public function getMetaBoxes(): array
    {
        return $this->metaBoxes;
    }
}
