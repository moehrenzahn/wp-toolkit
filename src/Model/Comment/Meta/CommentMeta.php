<?php

namespace Toolkit\Model\Comment\Meta;

/**
 * Class CommentMeta
 *
 * @package Toolkit
 */
class CommentMeta
{
    const TYPE_TEXT = 'Text';
    const TYPE_TEXTAREA = 'Textarea';
    const TYPE_BOOLEAN = 'Boolean';
    const TYPE_SELECT = 'Select';

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string[]|null
     */
    public $options;

    /**
     * @var string
     */
    public $type;

    /**
     * @var MetaManager;
     */
    private $metaManager;

    /**
     * CommentMeta constructor.
     *
     * @param string $title
     * @param string $slug
     * @param string $type
     * @param MetaManager $metaManager
     * @param string[]|null $options
     */
    public function __construct(
        $title,
        $slug,
        $type,
        MetaManager $metaManager,
        $options = null
    ) {
        $this->title = $title;
        $this->slug = $slug;
        $this->type = $type;
        $this->options = $options;
        $this->metaManager = $metaManager;
    }

    /**
     * @TODO: The comment ID needs to be passed in a better way.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->metaManager->get($_REQUEST['c'], $this->slug);
    }
}
