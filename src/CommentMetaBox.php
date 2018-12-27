<?php

namespace Toolkit;

use Toolkit\Block\Comment\MetaBox;
use Toolkit\Model\Comment\MetaAccessor;

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
     * @var MetaAccessor
     */
    private $metaAccessor;

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
     * @param MetaAccessor $metaAccessor
     */
    public function __construct(
        Loader $loader,
        Javascript $javascript,
        ImageSize $imageSize,
        MetaAccessor $metaAccessor
    ) {
        $this->loader = $loader;
        $this->javascript = $javascript;
        $this->imageSize = $imageSize;
        $this->metaAccessor = $metaAccessor;
    }

    /**
     * @param string $slug
     * @param string $title
     * @param \Toolkit\Model\Comment\CommentMeta[] $commentMeta
     * @param string $templatePath
     * @return Model\CommentMetaBox
     */
    public function add(
        string $slug,
        string $title,
        array $commentMeta,
        string $templatePath = 'Template/Comment/MetaBox'
    ) : \Toolkit\Model\CommentMetaBox {
        $block = new MetaBox($this->javascript, $this->imageSize, $templatePath, $commentMeta);
        $this->metaBoxes[$title] = new \Toolkit\Model\CommentMetaBox(
            $slug,
            $title,
            $block,
            $this->loader,
            $this->metaAccessor
        );

        return $this->metaBoxes[$title];
    }
}
