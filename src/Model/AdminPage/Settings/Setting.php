<?php

namespace Moehrenzahn\Toolkit\Model\AdminPage\Settings;

use Moehrenzahn\Toolkit\ConfigAccessor;
use \Moehrenzahn\Toolkit\Block\Settings\Setting as SettingBlock;
use Moehrenzahn\Toolkit\Api\Model\Settings\SettingInterface;

/**
 * Class Setting
 *
 * @package Moehrenzahn\Toolkit\Model\AdminPage\Settings
 */
class Setting implements SettingInterface
{
    /**
     * @var ConfigAccessor
     */
    private $configAccessor;

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
     * @var string[]
     */
    private $options;

    /**
     * @var SettingBlock
     */
    private $block;

    /**
     * Setting constructor.
     *
     * @param ConfigAccessor $configAccessor
     * @param $id
     * @param $title
     * @param $description
     * @param string[] $options
     * @param SettingBlock $block
     */
    public function __construct(
        ConfigAccessor $configAccessor,
        $id,
        $title,
        $description,
        array $options,
        SettingBlock $block
    ) {
        $this->configAccessor = $configAccessor;
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->options = $options;
        $this->block = $block;
        $this->block->setSetting($this);
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->configAccessor->getConfigValue($this->id);
    }

    /**
     * @return SettingBlock
     */
    public function getBlock(): SettingBlock
    {
        return $this->block;
    }
}
