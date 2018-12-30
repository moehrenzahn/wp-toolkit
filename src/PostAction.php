<?php
namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\Api\ActionInterface;

/**
 * Class PostAction
 *
 * @package Toolkit
 */
class PostAction
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * PostAction constructor.
     *
     * @param Loader $loader
     */
    public function __construct(\Moehrenzahn\Toolkit\Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $actionId
     * @param string $returnUrl
     * @param ActionInterface $action
     */
    public function add(string $actionId, string $returnUrl, ActionInterface $action)
    {
        $this->loader->addAction(
            "admin_post_$actionId",
            null,
            function () use ($action, $returnUrl) {
                $action->doAction($_POST);
                wp_redirect($returnUrl);
                exit;
            }
        );
    }
}
