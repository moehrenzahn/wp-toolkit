<?php

namespace Toolkit\Api\Model;

use Toolkit\Api\Client;
use Toolkit\Loader;

/**
 * Class AbstractAjaxAction
 *
 * @package Toolkit\Model
 */
abstract class AbstractAjaxAction
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var Client
     */
    protected $toolkit;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var array
     */
    protected $requestData;

    /**
     * AbstractAjaxAction constructor.
     *
     * @param Loader $loader
     * @param Client $toolkit
     * @param string $slug
     * @param bool $public
     */
    public function __construct(Loader $loader, Client $toolkit, string $slug, bool $public = false)
    {
        $this->loader = $loader;
        /**
         * @TODO: Once there is a separate object manager,
         *        it should be the dependency here and not the full Client.
         */
        $this->toolkit = $toolkit;
        $this->slug = $slug;
        $this->loader->addAction("wp_ajax_$this->slug", $this, 'doRequest');
        if ($public) {
            $this->loader->addAction("wp_ajax_nopriv_$this->slug", $this, 'doRequest');
        }
    }

    public function doRequest()
    {
        $this->requestData = $_POST;
        $this->action();
        die();
    }

    abstract public function action();

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
