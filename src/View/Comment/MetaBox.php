<?php

namespace Moehrenzahn\Toolkit\View\Comment;

use Moehrenzahn\Toolkit\View;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;
use Moehrenzahn\Toolkit\Model\Comment\CommentMeta;

/**
 * Class MetaBox
 *
 * @package Toolkit
 */
class MetaBox extends View
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
     * @param View\ViewFactory $viewFactory
     * @param string $templatePath
     * @param array $commentMeta
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        View\ViewFactory $viewFactory,
        string $templatePath,
        array $commentMeta
    ) {
        $this->commentMeta = $commentMeta;

        parent::__construct($javascript, $imageSize, $viewFactory, $templatePath);
    }


    /**
     * @return CommentMeta[]
     */
    public function getCommentMeta()
    {
        return $this->commentMeta;
    }
}
