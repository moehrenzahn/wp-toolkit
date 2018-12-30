<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\Block\Comment\MetaBox;
use Moehrenzahn\Toolkit\Helper\ObjectManager;

/**
 * Class CommentMetaBox
 *
 * @package Toolkit
 */
class CommentMetaBox
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var \Moehrenzahn\Toolkit\Model\CommentMetaBox[]
     */
    private $metaBoxes;

    /**
     * CommentMetaBox constructor.
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
     * @param \Moehrenzahn\Toolkit\Model\Comment\CommentMeta[] $commentMeta
     * @param string $templatePath
     * @return Model\CommentMetaBox
     */
    public function add(
        string $slug,
        string $title,
        array $commentMeta,
        string $templatePath = 'Template/Comment/MetaBox'
    ) : \Moehrenzahn\Toolkit\Model\CommentMetaBox {
        $block = $this->objectManager->create(
            MetaBox::class,
            ['templatePath' => $templatePath, 'commentMeta' => $commentMeta]
        );
        $this->metaBoxes[$title] = $this->objectManager->create(
            \Moehrenzahn\Toolkit\Model\CommentMetaBox::class,
            [
                'slug' => $slug,
                'title' => $title,
                'block' => $block,
            ]
        );

        return $this->metaBoxes[$title];
    }

    /**
     * @return Model\CommentMetaBox[]
     */
    public function getMetaBoxes(): array
    {
        return $this->metaBoxes;
    }
}
