<?php
namespace Toolkit;

use Toolkit\Api\Model\AbstractAjaxAction;

/**
 * Class AjaxAction
 *
 * @package Toolkit
 */
class AjaxAction
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var AbstractAjaxAction[]
     */
    private $actions;

    /**
     * AdminNotice constructor.
     *
     * @param \Toolkit\Loader $loader
     */
    public function __construct(\Toolkit\Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param AbstractAjaxAction $ajaxAction
     */
    public function add(AbstractAjaxAction $ajaxAction)
    {
        $this->actions[$ajaxAction->getSlug()] = $ajaxAction;
    }
}