<?php

namespace Toolkit;

use Toolkit\Block\Taxonomy\Meta;
use Toolkit\Helper\ObjectManager;

/**
 * Class TermMeta
 *
 * @package Toolkit
 */
class TermMeta
{
    const TYPE_CATEGORY = 'category';
    const TYPE_TAG = 'post_tag';

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var \Toolkit\Model\TermMeta[]
     */
    private $termMeta = [];

    /**
     * TermMeta constructor.
     *
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $slug
     * @param string $type
     * @param string $template
     * @param string $blockClass
     * @return Model\TermMeta
     */
    public function add(
        string $slug,
        string $type,
        string $template,
        $blockClass = Meta::class
    ) {
        $block = $this->objectManager->create(
            $blockClass,
            [
                'templatePath' => $template,
                'slug' => $slug
            ]
        );

        $this->termMeta[$slug] = $this->objectManager->create(
            \Toolkit\Model\TermMeta::class,
            ['block' => $block, 'type' => $type]
        );

        return $this->termMeta[$slug];
    }

    /**
     * @return Model\TermMeta[]
     */
    public function getTermMeta(): array
    {
        return $this->termMeta;
    }
}
