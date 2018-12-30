<?php

namespace Moehrenzahn\Toolkit\Block\Comment;

use Moehrenzahn\Toolkit\Block;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;
use Moehrenzahn\Toolkit\Model\Comment\CommentMeta;

/**
 * Class MetaBox
 *
 * @package Toolkit
 */
class MetaBox extends Block
{
    /**
     * @var CommentMeta[]
     */
    private $commentMeta;

    /**
     * MetaBox constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param Block\BlockFactory $blockFactory
     * @param string $templatePath
     * @param array $commentMeta
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        Block\BlockFactory $blockFactory,
        string $templatePath,
        array $commentMeta
    ) {
        $this->commentMeta = $commentMeta;

        parent::__construct($javascript, $imageSize, $blockFactory, $templatePath);
    }


    /**
     * @return CommentMeta[]
     */
    public function getCommentMeta()
    {
        return $this->commentMeta;
    }
}
