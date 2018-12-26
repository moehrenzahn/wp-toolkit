<?php

namespace Toolkit\Model\AdminPage\Settings;

use Toolkit\Api\Model\Settings\SectionInterface;
use Toolkit\Api\Model\Settings\SettingInterface;
use Toolkit\Block\Settings\Section as SectionBlock;

/**
 * Class Section
 *
 * @package Toolkit\Model\AdminPage\Settings
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
     * @var SectionBlock
     */
    public $block;

    /**
     * Section constructor.
     *
     * @param string $id
     * @param string $title
     * @param SettingInterface[] $settings
     * @param SectionBlock $block
     * @param string $description
     */
    public function __construct(
        string $id,
        string $title,
        array $settings,
        SectionBlock $block,
        string $description = ''
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->settings = $settings;
        $this->block = $block;
        $this->block->setSection($this);
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
