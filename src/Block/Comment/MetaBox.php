<?php

namespace Toolkit\Block\Comment;

use Toolkit\Block;
use Toolkit\Model\Comment\Meta\CommentMeta;

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
     * @return CommentMeta[]
     */
    public function getCommentMeta()
    {
        return $this->commentMeta;
    }

    /**
     * @param CommentMeta[] $commentMeta
     */
    public function setCommentMeta(array $commentMeta)
    {
        $this->commentMeta = $commentMeta;
    }
}
