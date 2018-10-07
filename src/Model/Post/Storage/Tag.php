<?php

namespace Toolkit\Model\Post\Storage;

use Toolkit\Model\Post\PreferenceInterface;

/**
 * Class Tag
 *
 * Use the preference slug as tag name.
 * The presence of the tag stores the boolean value of the preference
 *
 * @package Toolkit\Model\Post\Storage
 */
class Tag implements StorageInterface
{
    /**
     * @var TagManager
     */
    protected $tagManager;

    /**
     * Tag constructor.
     *
     * @param TagManager $tagManager
     */
    public function __construct(TagManager $tagManager)
    {
        $this->tagManager = $tagManager;
    }


    /**
     * @param PreferenceInterface $preference
     * @param string $value
     * @param int $postId
     */
    public function update(PreferenceInterface $preference, string $value, int $postId = 0)
    {
        $tag = $preference->getId();
        if ($value) {
            $this->tagManager->add($postId, $tag);
        } else {
            $this->delete($preference, $postId);
        }
    }

    /**
     * Saving without changing a value does not do anything for tag based storage
     *
     * @param PreferenceInterface $preference
     * @param int $postId
     */
    public function save(PreferenceInterface $preference, int $postId = 0)
    {
        return;
    }

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     *
     * @return bool
     */
    public function load(PreferenceInterface $preference, int $postId = 0)
    {
        $tag = $preference->getId();
        return $this->tagManager->hasTag($postId, $tag);
    }

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     */
    public function delete(PreferenceInterface $preference, int $postId = 0)
    {
        $tag = $preference->getId();
        $this->tagManager->remove($postId, $tag);
    }
}
