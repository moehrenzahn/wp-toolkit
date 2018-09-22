<?php

namespace Toolkit\Model\Comment\Meta;

/**
 * Class MetaManager
 *
 * @package Toolkit
 */
class MetaManager
{
    /**
     * @param int $commentId
     * @param string $slug
     * @return string
     */
    public function get($commentId, $slug)
    {
        return get_comment_meta(
            $commentId,
            $slug,
            true
        );
    }

    /**
     * @param int $commentId
     * @param string $slug
     * @param string $value
     */
    public function add($commentId, $slug, $value)
    {
        add_comment_meta(
            $commentId,
            $slug,
            $value
        );
    }

    /**
     * @param int $commentId
     * @param string $slug
     * @param string $value
     */
    public function update($commentId, $slug, $value)
    {
        update_comment_meta(
            $commentId,
            $slug,
            $value
        );
    }

    /**
     * @param int $commentId
     * @param string $slug
     */
    public function remove($commentId, $slug)
    {
        delete_comment_meta(
            $commentId,
            $slug
        );
    }
}
