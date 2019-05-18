<?php
namespace Moehrenzahn\Toolkit\Model;

use Moehrenzahn\Toolkit\Loader;
use Moehrenzahn\Toolkit\Model\Comment\MetaAccessor;
use Moehrenzahn\Toolkit\View\Comment\MetaBox as View;

/**
 * Class CommentMetaBox
 *
 * @package Moehrenzahn\Toolkit\Meta
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
     * @var View
     */
    private $view;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var MetaAccessor
     */
    private $metaAccessor;

    /**
     * @var int
     */
    private $currentCommentId;

    /**
     * CommentMetaBox constructor.
     *
     * @TODO: The CommentMeta models should be added here instead of in the view.
     *
     * @param $slug
     * @param $title
     * @param View $view
     * @param Loader $loader
     * @param MetaAccessor $metaAccessor
     */
    public function __construct(
        string $slug,
        string $title,
        View $view,
        Loader $loader,
        MetaAccessor $metaAccessor
    ) {
        $this->slug = $slug;
        $this->title = $title;
        $this->view = $view;
        $this->loader = $loader;
        $this->metaAccessor = $metaAccessor;

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
            [$this->view, 'renderTemplate'],
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
        foreach ($this->view->getCommentMeta() as $meta) {
            if (isset($_POST[$meta->slug])) {
                $this->metaAccessor->update($commentId, $meta->slug, esc_attr($_POST[$meta->slug]));
            } else {
                $this->metaAccessor->remove($commentId, $meta->slug);
            }
        }
    }
}
