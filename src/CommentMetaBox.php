<?php

namespace Toolkit;

use Toolkit\Block\Comment\MetaBox;
use Toolkit\Model\Comment\Meta\MetaManager;

/**
 * Class CommentMetaBox
 *
 * @package Toolkit
 */
class CommentMetaBox
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
     * @var MetaManager
     */
    private $metaManager;

    /**
     * @var ImageSize
     */
    private $imageSize;

    /**
     * @var \Toolkit\Model\CommentMetaBox[]
     */
    private $metaBoxes;

    /**
     * CommentMetaBox constructor.
     *
     * @param Loader $loader
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param MetaManager $metaManager
     */
    public function __construct(
        Loader $loader,
        Javascript $javascript,
        ImageSize $imageSize,
        MetaManager $metaManager
    ) {
        $this->loader = $loader;
        $this->javascript = $javascript;
        $this->imageSize = $imageSize;
        $this->metaManager = $metaManager;
    }

    /**
     * @param string $slug
     * @param string $title
     * @param string $templatePath
     * @param string $templateType
     */
    public function add(string $slug, string $title, string $templatePath, string $templateType = 'phtml')
    {
        $block = new MetaBox($this->javascript, $this->imageSize, $templatePath, $templateType);
        $this->metaBoxes[$title] = new \Toolkit\Model\CommentMetaBox(
            $slug,
            $title,
            $block,
            $this->loader,
            $this->metaManager
        );
    }
}
