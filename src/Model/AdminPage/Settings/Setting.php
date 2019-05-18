<?php

namespace Moehrenzahn\Toolkit\Model\AdminPage\Settings;

use Moehrenzahn\Toolkit\ConfigAccessor;
use \Moehrenzahn\Toolkit\View\Settings\Setting as SettingView;
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
     * @var SettingView
     */
    private $view;

    /**
     * Setting constructor.
     *
     * @param ConfigAccessor $configAccessor
     * @param $id
     * @param $title
     * @param $description
     * @param string[] $options
     * @param SettingView $view
     */
    public function __construct(
        ConfigAccessor $configAccessor,
        $id,
        $title,
        $description,
        array $options,
        SettingView $view
    ) {
        $this->configAccessor = $configAccessor;
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->options = $options;
        $this->view = $view;
        $this->view->setSetting($this);
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
     * @return SettingView
     */
    public function getView(): SettingView
    {
        return $this->view;
    }
}
