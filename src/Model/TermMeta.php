<?php

namespace Moehrenzahn\Toolkit\Model;

use Moehrenzahn\Toolkit\View\Taxonomy\Meta;
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
    private $view;

    /**
     * Can be 'category' or 'post_tag'.
     *
     * @var string
     */
    private $type;

    /**
     * TermMeta constructor.
     *
     * @param Meta $view
     * @param string $type
     * @param Loader $loader
     * @param TermMetaSave $saveController
     */
    public function __construct(Loader $loader, TermMetaSave $saveController, Meta $view, $type)
    {
        $this->loader = $loader;
        $this->saveController = $saveController;
        $this->view = $view;
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
        $this->view->renderTemplate();
    }

    /**
     * Edit category page
     *
     * @param \WP_Term $term
     */
    public function editField($term)
    {
        $this->view->setTermId($term->term_id);
        $this->view->renderTemplate();
    }

    /**
     * Save extra taxonomy fields callback function.
     *
     * @param int $termId
     */
    public function save($termId)
    {
        $request = $_POST;
        $this->view->setTermId($termId);
        $this->saveController->doSaveAction(
            $request,
            $termId,
            $this->view->getSlug()
        );
    }
}
