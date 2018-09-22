<?php

namespace Toolkit\AdminPage\Settings;

use Toolkit\Block\Settings\Section as SectionBlock;

class Section
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
     * @var Setting[]
     */
    private $settings;

    /**
     * @var SectionBlock
     */
    public $block;

    /**
     * Section constructor.
     *
     * @param string $id
     * @param string $title
     * @param Setting[] $settings
     * @param SectionBlock $block
     * @param string $description
     */
    public function __construct(
        $id,
        $title,
        $settings,
        SectionBlock $block,
        $description = ''
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Setting[]
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
