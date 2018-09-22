<?php

namespace Toolkit\AdminPage\Settings;

use Toolkit\ConfigAccessor;
use \Toolkit\Block\Settings\Setting as SettingBlock;
use Toolkit\SettingInterface;

class Setting implements SettingInterface
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
     * @var ConfigAccessor
     */
    private $configAccessor;

    /**
     * @var SettingBlock
     */
    public $block;

    /**
     * Setting constructor.
     *
     * @param string $id
     * @param string $title
     * @param string $description
     * @param SettingBlock $block
     */
    public function __construct($id, $title, $description, SettingBlock $block)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->block = $block;
        $this->block->setSetting($this);
        $this->configAccessor = new ConfigAccessor();
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->configAccessor->getConfigValue($this->id);
    }
}
