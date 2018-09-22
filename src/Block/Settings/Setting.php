<?php

namespace Toolkit\Block\Settings;

use Toolkit\Block;
use Toolkit\SettingInterface;

class Setting extends Block
{
    /**
     * @var SettingInterface
     */
    private $setting;

    /**
     * Setting constructor.
     *
     * @param SettingInterface|null $setting
     * @param string $templatePath
     */
    public function __construct($templatePath, $setting = null)
    {
        $this->setting = $setting;

        parent::__construct($templatePath);
    }

    /**
     * @return SettingInterface
     */
    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * @param SettingInterface $setting
     */
    public function setSetting(SettingInterface $setting)
    {
        $this->setting = $setting;
    }
}
