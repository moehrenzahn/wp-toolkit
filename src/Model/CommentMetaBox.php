<?php
namespace Toolkit\Model;

use Toolkit\Loader;
use Toolkit\Model\Comment\Meta\MetaManager;
use Toolkit\Block\Comment\MetaBox as Block;

/**
 * Class CommentMetaBox
 *
 * @package Toolkit\Meta
 */
class CommentMetaBox
{
    const HOOK_ADD = 'add_meta_boxes_comment';
    const HOOK_EDIT = 'edit_comment';

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Block
     */
    private $block;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var MetaManager
     */
    private $metaManager;

    /**
     * @var int
     */
    private $currentCommentId;

    /**
     * CommentMetaBox constructor.
     *
     * @TODO: The CommentMeta models should be added here instead of in the block.
     *
     * @param $slug
     * @param $title
     * @param Block $block
     * @param Loader $loader
     * @param MetaManager $metaManager
     */
    public function __construct(
        string $slug,
        string $title,
        Block $block,
        Loader $loader,
        MetaManager $metaManager
    ) {
        $this->slug = $slug;
        $this->title = $title;
        $this->block = $block;
        $this->loader = $loader;
        $this->metaManager = $metaManager;

        $this->loader->addAction(self::HOOK_ADD, $this, 'addMetaBox');
        $this->loader->addAction(self::HOOK_EDIT, $this, 'saveData');
    }

    /**
     * Called by WordPress action
     *
     * @param \WP_Comment $comment
     */
    public function addMetaBox(\WP_Comment $comment)
    {
        $this->currentCommentId = $comment->comment_ID;
        add_meta_box(
            $this->slug,
            $this->title,
            [$this->block, 'renderTemplate'],
            'comment',
            'normal',
            'high'
        );
    }

    /**
     * Called by WordPress action
     *
     * @param int $commentId
     */
    public function saveData($commentId)
    {
        foreach ($this->block->getCommentMeta() as $meta) {
            if (isset($_POST[$meta->slug])) {
                $this->metaManager->update($commentId, $meta->slug, esc_attr($_POST[$meta->slug]));
            } else {
                $this->metaManager->remove($commentId, $meta->slug);
            }
        }
    }
}