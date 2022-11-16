<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\View\Taxonomy\Meta;
use Moehrenzahn\Toolkit\Helper\ObjectManager;

/**
 * Class TermMeta
 *
 * @package Toolkit
 */
class TermMeta
{
    const TYPE_CATEGORY = 'category';
    const TYPE_TAG = 'post_tag';

    const INPUT_TYPE_TEXT = 'Text';
    const INPUT_TYPE_TEXTAREA = 'Textarea';
    const INPUT_TYPE_BOOLEAN = 'Boolean';
    const INPUT_TYPE_SELECT = 'Select';
    const INPUT_TYPE_MEDIA = 'Media';
    const INPUT_TYPE_LIST = 'List';
    const INPUT_TYPES = [
        self::INPUT_TYPE_TEXT,
        self::INPUT_TYPE_TEXTAREA,
        self::INPUT_TYPE_BOOLEAN,
        self::INPUT_TYPE_SELECT,
        self::INPUT_TYPE_MEDIA,
        self::INPUT_TYPE_LIST
    ];

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var \Moehrenzahn\Toolkit\Model\TermMeta[]
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
     * @param string $title
     * @param string $type "category" or "post_tag"
     * @param string $inputType
     * @param string[] $options
     * @param string $description
     * @return Model\TermMeta
     */
    public function add(
        string $slug,
        string $title,
        string $type,
        string $inputType,
        array $options = [],
        string $description = ''
    ) {
        $view = $this->objectManager->create(
            Meta::class,
            [
                'templatePath' => $this->getTemplateFor($inputType),
                'slug' => $slug,
                'title' => $title,
                'options' => $options,
                'description' => $description,
            ]
        );

        $this->termMeta[$slug] = $this->objectManager->create(
            \Moehrenzahn\Toolkit\Model\TermMeta::class,
            ['view' => $view, 'type' => $type]
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

    /**
     * @param string $slug
     * @return false|Model\TermMeta
     */
    public function getTermMetaBySlug(string $slug)
    {
        return $this->termMeta[$slug] ?? false;
    }

    private function getTemplateFor(string $inputType)
    {
        if (!in_array($inputType, self::INPUT_TYPES)) {
            $inputType = self::INPUT_TYPE_BOOLEAN;
        }

        return TOOLKIT_TEMPLATE_FOLDER . 'Taxonomy/Meta/' . $inputType;
    }
}
