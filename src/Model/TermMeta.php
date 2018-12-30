<?php

namespace Moehrenzahn\Toolkit\Model;

use Moehrenzahn\Toolkit\Block\Taxonomy\Meta;
use Moehrenzahn\Toolkit\Loader;
use Moehrenzahn\Toolkit\Model\Action\TermMetaSave;

/**
 * Class TermMeta
 *
 * Offers methods for WordPress action hooks to display and update term meta:
 *
 * '$type_edit_form_fields' => 'editField'
 * 'edited_$type' => 'save'
 * 'created_$type' => 'save'
 * '$type_add_form_fields' => 'addField'
 *
 * @package Moehrenzahn\Toolkit\Model
 */
class TermMeta
{
    /**
     * @var Loader
     */
    protected $loader;

    /**
     * @var TermMetaSave
     */
    private $saveController;

    /**
     * @var Meta
     */
    private $block;

    /**
     * Can be 'category' or 'post_tag'.
     *
     * @var string
     */
    private $type;

    /**
     * TermMeta constructor.
     *
     * @param Meta $block
     * @param string $type
     * @param Loader $loader
     * @param TermMetaSave $saveController
     */
    public function __construct(Loader $loader, TermMetaSave $saveController, Meta $block, $type)
    {
        $this->loader = $loader;
        $this->saveController = $saveController;
        $this->block = $block;
        $this->type = $type;

        $this->loader->addAction("{$type}_edit_form_fields", $this, "editField");
        $this->loader->addAction("edited_$type", $this, "save");
        $this->loader->addAction("created_$type", $this, "save");
        $this->loader->addAction("{$type}_add_form_fields", $this, "addField");
    }

    /**
     * This will add the custom meta field to the add new category page.
     */
    public function addField()
    {
        $this->block->renderTemplate();
    }

    /**
     * Edit category page
     *
     * @param \WP_Term $term
     */
    public function editField($term)
    {
        $this->block->setTermId($term->term_id);
        $this->block->renderTemplate();
    }

    /**
     * Save extra taxonomy fields callback function.
     *
     * @param int $termId
     */
    public function save($termId)
    {
        $request = $_POST;
        $this->block->setTermId($termId);
        $this->saveController->doSaveAction(
            $request,
            $termId,
            $this->block->getSlug()
        );
    }
}
