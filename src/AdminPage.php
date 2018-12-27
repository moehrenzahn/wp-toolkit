<?php

namespace Toolkit;

use Toolkit\Api\Model\Settings\SectionInterface;
use Toolkit\Block\Settings;
use Toolkit\Helper\ObjectManager;

/**
 * Class AdminPage
 *
 * @package Toolkit
 */
class AdminPage
{
    /**
     * @var \Toolkit\Model\AdminPage[]
     */
    private $adminPages = [];

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * AdminPage constructor.
     *
     * @param Loader $loader
     * @param ObjectManager $objectManager
     */
    public function __construct(Loader $loader, ObjectManager $objectManager)
    {
        $this->loader = $loader;
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $title
     * @param string $slug
     * @param string $icon
     * @param int $position
     * @param string $templatePath
     * @return Model\AdminPage
     */
    public function add(
        string $title,
        string $slug,
        string $icon,
        int $position,
        string $templatePath
    ) {
        $block = $this->objectManager->create(Block::class, ['templatePath' => $templatePath]);
        $this->adminPages[$slug] = new \Toolkit\Model\AdminPage(
            $this->loader,
            $title,
            $slug,
            $icon,
            $position,
            $block
        );

        return $this->adminPages[$slug];
    }

    /**
     * @param string $title
     * @param string $slug
     * @param SectionInterface[] $sections
     */
    public function addSettingsPage(
        string $title,
        string $slug,
        array $sections
    ) {
        $block = $this->objectManager->create(Settings::class, ['title' => $title, 'page' => $slug]);
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

    /**
     * @param string $id
     * @return null|\Toolkit\Model\AdminPage
     */
    public function getAdminPageById(string $id)
    {
        return $this->adminPages[$id] ?? null;
    }
}
