<?php

namespace Moehrenzahn\Toolkit\Model\Post\Storage;

use Moehrenzahn\Toolkit\Helper\Request;
use Moehrenzahn\Toolkit\Model\Post\PreferenceInterface;

/**
 * Class Meta
 *
 * @package Moehrenzahn\Toolkit\Model\Post\Storage
 */
class Meta implements StorageInterface
{
    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     * @return string|null
     */
    public function load(PreferenceInterface $preference, int $postId = 0)
    {
        if (!$postId) {
            global $post;
            $postId = $post->ID;
        }
        $key = $preference->getId();

        return get_post_meta(
            $postId,
            $key,
            true
        );
    }

    /**
     * @param PreferenceInterface $preference
     * @param string $value
     * @param int $postId
     */
    public function update(PreferenceInterface $preference, string $value, int $postId = 0)
    {
        $key = $preference->getId();
        update_post_meta(
            $postId,
            $key,
            $value
        );
    }

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     */
    public function save(PreferenceInterface $preference, int $postId = 0)
    {
        $key = $preference->getId();
        if (!Request::isAutosave()) {
            update_post_meta(
                $postId,
                $key,
                $preference->getValue()
            );
        }
    }

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     */
    public function delete(PreferenceInterface $preference, int $postId = 0)
    {
        $key = $preference->getId();
        delete_post_meta(
            $postId,
            $key
        );
    }
}
