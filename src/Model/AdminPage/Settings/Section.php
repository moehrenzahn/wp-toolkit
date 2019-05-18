<?php

namespace Moehrenzahn\Toolkit\Model\AdminPage\Settings;

use Moehrenzahn\Toolkit\Api\Model\Settings\SectionInterface;
use Moehrenzahn\Toolkit\Api\Model\Settings\SettingInterface;
use Moehrenzahn\Toolkit\View\Settings\Section as SectionView;

/**
 * Class Section
 *
 * @package Moehrenzahn\Toolkit\Model\AdminPage\Settings
 */
class Section implements SectionInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var SettingInterface[]
     */
    private $settings = [];

    /**
     * @var SectionView
     */
    public $view;

    /**
     * Section constructor.
     *
     * @param string $id
     * @param string $title
     * @param SettingInterface[] $settings
     * @param SectionView $view
     * @param string $description
     */
    public function __construct(
        string $id,
        string $title,
        array $settings,
        SectionView $view,
        string $description = ''
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->settings = $settings;
        $this->view = $view;
        $this->view->setSection($this);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return SettingInterface[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
