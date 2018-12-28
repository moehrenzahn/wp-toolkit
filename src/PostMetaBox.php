<?php

namespace Toolkit;

use Toolkit\Block\BlockFactory;
use Toolkit\Block\Post\MetaBox;
use Toolkit\Helper\ObjectManager;

/**
 * Class PostMetaBox
 *
 * @package Toolkit\PostMetaBox
 */
class PostMetaBox
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var \Toolkit\Model\PostMetaBox[]
     */
    private $metaBoxes = [];

    /**
     * PostMetaBox constructor.
     *
     * @param Loader $loader
     * @param ObjectManager $objectManager
     */
    public function __construct(Loader $loader, ObjectManager $objectManager)
    {
        $this->loader = $loader;
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $title
     * @param string $slug
     * @param string $templatePath
     * @param \Toolkit\Model\Post\PostPreference[] $postPreferences
     * @return Model\PostMetaBox
     */
    public function add(
        string $title,
        string $slug,
        array $postPreferences = [],
        string $templatePath = 'Template/MetaBox/MetaBox'
    ) {
        /** @var MetaBox $block */
        $block = $this->objectManager->create(
            MetaBox::class,
            [
                'templatePath' => $templatePath,
                'postPreferences' => $postPreferences
            ]
        );
        $this->metaBoxes[$slug] = $this->objectManager->create(
            \Toolkit\Model\PostMetaBox::class,
            [
                'title' => $title,
                'slug' => $slug,
                'postPreferences' => $postPreferences,
                'block' => $block,
            ]
        );

        return $this->metaBoxes[$title];
    }

    /**
     * @return Model\PostMetaBox[]
     */
    public function getMetaBoxes(): array
    {
        return $this->metaBoxes;
    }
}
