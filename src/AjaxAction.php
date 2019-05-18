<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\Api\ActionInterface;

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
     * AdminNotice constructor.
     *
     * @param \Moehrenzahn\Toolkit\Loader $loader
     */
    public function __construct(\Moehrenzahn\Toolkit\Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $actionId
     * @param ActionInterface $action
     * @param bool $public
     */
    public function add(string $actionId, ActionInterface $action, $public = false)
    {
        $this->loader->addAction(
            "wp_ajax_$actionId",
            null,
            function () use ($action) {
                $action->doAction($_POST);
                wp_die();
            }
        );
        if ($public) {
            $this->loader->addAction(
                "wp_ajax_nopriv_$actionId",
                null,
                function () use ($action) {
                    $action->doAction($_POST);
                    wp_die();
                }
            );
        }
    }
}
