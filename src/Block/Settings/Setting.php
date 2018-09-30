<?php

namespace Toolkit\Block\Settings;

use Toolkit\Block;
use Toolkit\ImageSize;
use Toolkit\Javascript;
use Toolkit\Api\Model\Settings\SettingInterface;

/**
 * Class Setting
 *
 * @package Toolkit\Block
 */
class Setting extends Block
{
    /**
     * @var SettingInterface
     */
    private $setting;

    /**
     * Setting constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param string $templatePath
     * @param string $templateType
     * @param SettingInterface $setting
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        string $templatePath = '',
        string $templateType = 'phtml',
        SettingInterface $setting
    ) {
        $this->setting = $setting;

        parent::__construct($javascript, $imageSize, $templatePath, $templateType);
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
