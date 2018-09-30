<?php

namespace Toolkit\Api\Model;

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
     * @var string
     */
    protected $slug;

    /**
     * @var array
     */
    protected $requestData;

    /**
     * Ajax constructor.
     *
     * @param Loader $loader
     * @param string $slug
     * @param bool $public
     */
    public function __construct(Loader $loader, string $slug, bool $public = false)
    {
        $this->loader = $loader;
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
