<?php
namespace Toolkit;

use Toolkit\Api\ActionInterface;

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
     * @param \Toolkit\Loader $loader
     */
    public function __construct(\Toolkit\Loader $loader)
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
