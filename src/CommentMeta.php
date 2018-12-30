<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\Model\Comment\MetaAccessor;

/**
 * Class CommentMeta
 *
 * @package Toolkit
 */
class CommentMeta
{
    /**
     * @var MetaAccessor
     */
    private $metaAccessor;

    /**
     * @var \Moehrenzahn\Toolkit\Model\Comment\CommentMeta[]
     */
    private $commentMeta;

    /**
     * CommentMeta constructor.
     *
     * @param MetaAccessor $metaAccessor
     */
    public function __construct(
        MetaAccessor $metaAccessor
    ) {
        $this->metaAccessor = $metaAccessor;
    }

    /**
     * @param string $title
     * @param string $slug
     * @param string $type
     * @param string|null $options
     * @return \Moehrenzahn\Toolkit\Model\Comment\CommentMeta
     */
    public function add(
        string $title,
        string $slug,
        string $type,
        $options = null
    ) {
        $this->commentMeta[$slug] = new \Moehrenzahn\Toolkit\Model\Comment\CommentMeta(
            $title,
            $slug,
            $type,
            $this->metaAccessor,
            $options
        );

        return $this->commentMeta[$slug];
    }

    /**
     * @return Model\Comment\CommentMeta[]
     */
    public function getCommentMeta(): array
    {
        return $this->commentMeta;
    }

    /**
     * @param string $slug
     * @return Model\Comment\CommentMeta
     * @throws \Exception
     */
    public function getBySlug(string $slug): \Moehrenzahn\Toolkit\Model\Comment\CommentMeta
    {
        if (isset($this->commentMeta[$slug])) {
            return $this->commentMeta[$slug];
        }
        throw new \Exception("Comment meta '$slug' was never initialized.");
    }
}
