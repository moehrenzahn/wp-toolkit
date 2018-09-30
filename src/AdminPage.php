<?php

namespace Toolkit;

use Toolkit\Api\Model\Settings\SectionInterface;

/**
 * Class AdminPage
 *
 * @package Toolkit
 */
class AdminPage
{
    /**
     * @var AdminPage[]
     */
    private $adminPages = [];

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var Javascript
     */
    private $javascript;

    /**
     * @var ImageSize
     */
    private $imageSize;

    /**
     * AdminPage constructor.
     *
     * @param Loader $loader
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     */
    public function __construct(Loader $loader, Javascript $javascript, ImageSize $imageSize)
    {
        $this->loader = $loader;
        $this->javascript = $javascript;
        $this->imageSize = $imageSize;
    }

    /**
     * @param string $title
     * @param int $slug
     * @param string $icon
     * @param int $position
     * @param string $templatePath
     * @param string $templateType
     */
    public function add(
        string $title,
        int $slug,
        string $icon,
        int $position,
        string $templatePath,
        string $templateType = 'phtml'
    ) {
        $block = new Block(
            $this->javascript,
            $this->imageSize,
            $templatePath,
            $templateType
        );
        $this->adminPages[$slug] = new \Toolkit\Model\AdminPage(
            $this->loader,
            $title,
            $slug,
            $icon,
            $position,
            $block
        );
    }

    /**
     * @param string $title
     * @param string $slug
     * @param SectionInterface[] $sections
     */
    public function addSettings(
        string $title,
        string $slug,
        array $sections
    ) {
        $block = new \Toolkit\Block\Settings(
            $this->javascript,
            $this->imageSize,
            $title,
            $slug
        );
        $this->adminPages[$slug] = new \Toolkit\Model\AdminPage\Settings(
            $this->loader,
            $block,
            $title,
            $slug,
            $sections
        );
    }

    /**
     * @return AdminPage[]
     */
    public function getAdminPages(): array
    {
        return $this->adminPages;
    }
}
