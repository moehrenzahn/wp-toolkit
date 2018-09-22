<?php

namespace Toolkit\Model;

use Toolkit\Helper\Strings;

/**
 * Class Stylesheet
 *
 * @package Pax\Wordpress
 */
class Stylesheet
{
    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var string
     */
    private $version;

    /**
     * Stylesheet constructor.
     *
     * @param string $slug
     * @param string $filePath
     * @param string $version
     */
    public function __construct(string $slug, string $filePath, string $version)
    {
        $this->slug = $slug;
        if (!Strings::endsWith($filePath, '.css')) {
            $filePath .= '.css';
        }
        $this->filePath = $filePath;
        $this->version = $version;

        $this->enqueueStyle();
    }

    private function enqueueStyle()
    {
        wp_enqueue_style(
            $this->slug,
            get_stylesheet_directory_uri() . '/' . $this->filePath,
            [],
            $this->version
        );
    }
}
