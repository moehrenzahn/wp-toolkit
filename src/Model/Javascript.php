<?php

namespace Toolkit\Model;

use Toolkit\Helper\Strings;

/**
 * Class Javascript
 *
 * @package Toolkit\Model
 */
class Javascript
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
     * @var string[]
     */
    private $dependencies = [];

    /**
     * Javascript constructor.
     *
     * @param string $slug
     * @param string $filePath
     * @param string $version
     * @param string[] $dependencies
     */
    public function __construct(string $slug, string $filePath, string $version, array $dependencies)
    {
        $this->slug = $slug;
        $this->filePath = $filePath;
        $this->version = $version;
        $this->dependencies = $dependencies;

        if (!Strings::endsWith($filePath, '.js')) {
            $filePath .= '.js';
        }
        if (!Strings::startsWith($filePath, '/')) {
            $filePath = '/' . $filePath;
        }
        wp_register_script(
            $slug,
            get_stylesheet_directory_uri() . $filePath,
            $dependencies,
            $version,
            true
        );
        wp_enqueue_script($slug);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return $this->dependencies;
    }
}
