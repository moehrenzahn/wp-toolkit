<?php

namespace Toolkit\Api\Model\AdminPage;

use Toolkit\Loader;

/**
 * Class AbstractPostAction
 *
 * For use in a settings page.
 *
 * @package Toolkit\AdminPage
 */
abstract class AbstractPostAction
{
    /**
     * @var string
     */
    private $actionId;

    /**
     * @var string
     */
    private $returnUrl;

    /**
     * @var Loader
     */
    protected $loader;

    /**
     * AbstractPostAction constructor.
     *
     * @param Loader $loader
     * @param string $actionId
     * @param string $returnUrl
     */
    public function __construct(Loader $loader, string $actionId, string $returnUrl)
    {
        $this->actionId = $actionId;
        $this->returnUrl = $returnUrl;
        $this->loader = $loader;

        $this->loader->addAction("admin_post_$actionId", $this, 'doAction');
    }

    /**
     * Perform POST action.
     *
     */
    public function doAction()
    {
        $this->action();
        wp_redirect($this->returnUrl);
        exit;
    }

    abstract protected function action();
}
