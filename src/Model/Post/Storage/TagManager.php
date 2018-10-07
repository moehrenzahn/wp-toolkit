<?php

namespace Toolkit\Model\Post\Storage;

/**
 * Class TagManager
 *
 * Add, remove and check for post tags.
 *
 * @package Toolkit\Model\Post\Storage
 */
class TagManager
{
    /**
     * @param int $postId
     * @param string $tag
     */
    public function add(int $postId, string $tag)
    {
        if (!$this->hasTag($postId, $tag)) {
            wp_set_post_tags(
                $postId,
                $tag,
                true
            );
        }
    }

    /**
     * @param int $postId
     * @param string $tag
     */
    public function remove(int $postId, string $tag)
    {
        /** @var \WP_Term[] $postTags */
        $postTags = wp_get_post_tags($postId);
        if (empty($postTags)) {
            return;
        }

        foreach ($postTags as $postTag) {
            $tagNames[] = $postTag->name;
        }
        $tags = array_filter(
            $tagNames,
            function ($tagName) use ($tag) {
                return $tagName !== $tag;
            }
        );
        wp_set_post_tags(
            $postId,
            $tags,
            false
        );
    }

    /**
     * @param int $postId
     * @param string $tag
     *
     * @return bool
     */
    public function hasTag(int $postId, string $tag)
    {
        $tag = get_term_by('name', $tag, 'post_tag');
        $tags = wp_get_post_tags($postId);

        return in_array($tag, $tags);
    }
}
