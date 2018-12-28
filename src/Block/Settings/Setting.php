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
     * @var SettingInterface|null
     */
    private $setting;

    /**
     * Setting constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param Block\BlockFactory $blockFactory
     * @param string $templatePath
     * @param SettingInterface|null $setting
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        Block\BlockFactory $blockFactory,
        string $templatePath = '',
        SettingInterface $setting = null
    ) {
        $this->setting = $setting;

        parent::__construct($javascript, $imageSize, $blockFactory, $templatePath);
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
