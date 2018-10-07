<?php

namespace Toolkit;

use Toolkit\Block\Post\MetaBox;

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
     * @param string $slug
     * @param string $templatePath
     * @param string $templateType
     * @param \Toolkit\Model\Post\PostPreference[] $postPreferences
     * @return Model\PostMetaBox
     */
    public function add(
        string $title,
        string $slug,
        array $postPreferences = [],
        string $templatePath = 'Template/MetaBox/MetaBox.phtml',
        string $templateType = 'phtml'
    ) {
        $block = new MetaBox($this->javascript, $this->imageSize, $templatePath, $templateType, $postPreferences);
        $this->metaBoxes[$slug] = new \Toolkit\Model\PostMetaBox(
            $title,
            $slug,
            $postPreferences,
            $block,
            $this->loader
        );

        return $this->metaBoxes[$title];
    }

    /**
     * @return Model\PostMetaBox[]
     */
    public function getMetaBoxes(): array
    {
        return $this->metaBoxes;
    }
}
