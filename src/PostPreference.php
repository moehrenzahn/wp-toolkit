<?php

namespace Toolkit;

use Toolkit\Model\Post\Storage\Meta;
use Toolkit\Model\Post\Storage\Tag;

/**
 * Class PostPreference
 *
 * @package Toolkit
 */
class PostPreference
{
    const TYPE_TAG = 'tag';
    const TYPE_META = 'meta';

    /**
     * @var Meta
     */
    private $metaStorage;

    /**
     * @var Tag
     */
    private $tagStorage;

    /**
     * @var \Toolkit\Model\Post\PostPreference[]
     */
    private $postPreferences;

    /**
     * PostPreference constructor.
     *
     * @param Meta $metaStorage
     * @param Tag $tagStorage
     */
    public function __construct(
        Meta $metaStorage,
        Tag $tagStorage
    ) {
        $this->metaStorage = $metaStorage;
        $this->tagStorage = $tagStorage;
    }


    /**
     * @param string $slug
     * @param string $title
     * @param string $description
     * @param string $type The input type for rendering, see \Toolkit\Model\Post\PostPreference
     * @param string $storageType The storage type, 'meta' or 'tag'
     * @param string|null $options
     * @return \Toolkit\Model\Post\PostPreference
     */
    public function add(
        string $slug,
        string $title,
        string $description = '',
        string $type = \Toolkit\Model\Post\PostPreference::TYPE_BOOLEAN,
        string $storageType = self::TYPE_META,
        $options = null
    ) {
        if ($storageType === self::TYPE_TAG) {
            $storage = $this->tagStorage;
        } else {
            $storage = $this->metaStorage;
        }

        $this->postPreferences[$slug] = new \Toolkit\Model\Post\PostPreference(
            $title,
            $slug,
            $description,
            $type,
            $storage,
            $options
        );

        return $this->postPreferences[$slug];
    }

    /**
     * @return Model\Post\PostPreference[]
     */
    public function getPostPreferences(): array
    {
        return $this->postPreferences;
    }

    /**
     * @param string $slug
     * @return Model\Post\PostPreference
     * @throws \Exception
     */
    public function getBySlug(string $slug): \Toolkit\Model\Post\PostPreference
    {
        if (isset($this->postPreferences[$slug])) {
            return $this->postPreferences[$slug];
        }
        throw new \Exception("Post preference '$slug' was never initialized.");
    }
}
