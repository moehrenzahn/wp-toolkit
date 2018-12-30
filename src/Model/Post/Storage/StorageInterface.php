<?php

namespace Moehrenzahn\Toolkit\Model\Post\Storage;

use Moehrenzahn\Toolkit\Model\Post\PreferenceInterface;

/**
 * Interface StorageInterface
 *
 * Store preferences in their respective Wordpress storage mechanism
 */
interface StorageInterface
{
    /**
     * @param PreferenceInterface $preference
     * @param string $value
     * @param int $postId
     */
    public function update(PreferenceInterface $preference, string $value, int $postId = 0);

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     */
    public function save(PreferenceInterface $preference, int $postId = 0);

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     * @return string|null
     */
    public function load(PreferenceInterface $preference, int $postId = 0);

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     */
    public function delete(PreferenceInterface $preference, int $postId = 0);
}
