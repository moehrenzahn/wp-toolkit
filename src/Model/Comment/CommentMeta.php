<?php

namespace Moehrenzahn\Toolkit\Model\Comment;

/**
 * Class CommentMeta
 *
 * @package Moehrenzahn\Toolkit\Model\Comment
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
     * @var MetaAccessor;
     */
    private $metaAccessor;

    /**
     * CommentMeta constructor.
     *
     * @param string $title
     * @param string $slug
     * @param string $type
     * @param MetaAccessor $metaAccessor
     * @param string[]|null $options
     */
    public function __construct(
        string $title,
        string $slug,
        string $type,
        MetaAccessor $metaAccessor,
        $options = null
    ) {
        $this->title = $title;
        $this->slug = $slug;
        $this->type = $type;
        $this->options = $options;
        $this->metaAccessor = $metaAccessor;
    }

    /**
     * Get the comment id from the current admin url.
     * This will only work in the comment detail view in the admin area.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->metaAccessor->get($_REQUEST['c'], $this->slug) ?? '';
    }
}
