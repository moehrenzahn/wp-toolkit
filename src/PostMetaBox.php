<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\View\Post\MetaBox;
use Moehrenzahn\Toolkit\Helper\ObjectManager;

/**
 * Class PostMetaBox
 *
 * @package Moehrenzahn\Toolkit\PostMetaBox
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
     * @var \Moehrenzahn\Toolkit\Model\PostMetaBox[]
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
     * @param \Moehrenzahn\Toolkit\Model\Post\PostPreference[] $postPreferences
     * @return Model\PostMetaBox
     */
    public function add(
        string $title,
        string $slug,
        array $postPreferences = [],
        string $templatePath = 'Template/MetaBox/MetaBox'
    ) {
        /** @var MetaBox $view */
        $view = $this->objectManager->create(
            MetaBox::class,
            [
                'templatePath' => $templatePath,
                'postPreferences' => $postPreferences
            ]
        );
        $this->metaBoxes[$slug] = $this->objectManager->create(
            \Moehrenzahn\Toolkit\Model\PostMetaBox::class,
            [
                'title' => $title,
                'slug' => $slug,
                'postPreferences' => $postPreferences,
                'view' => $view,
            ]
        );

        return $this->metaBoxes[$slug];
    }

    /**
     * More flexible version of add.
     * Use this to add a meta box to a custom post type
     * or to define the "context" (position) of the meta box.
     */
    public function addCustom(
        string $title,
        string $slug,
        string $screenName,
        string $context = 'side',
        array $postPreferences = [],
        string $templatePath = 'Template/MetaBox/MetaBox'
    ) {
        /** @var MetaBox $view */
        $view = $this->objectManager->create(
            MetaBox::class,
            [
                'templatePath' => $templatePath,
                'postPreferences' => $postPreferences
            ]
        );
        $this->metaBoxes[$slug] = $this->objectManager->create(
            \Moehrenzahn\Toolkit\Model\CustomMetaBox::class,
            [
                'title' => $title,
                'slug' => $slug,
                'screenName' => $screenName,
                'context' => $context,
                'postPreferences' => $postPreferences,
                'view' => $view,
            ]
        );

        return $this->metaBoxes[$slug];
    }



    /**
     * @return Model\PostMetaBox[]
     */
    public function getMetaBoxes(): array
    {
        return $this->metaBoxes;
    }
}
