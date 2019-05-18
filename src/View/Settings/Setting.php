<?php

namespace Moehrenzahn\Toolkit\View\Settings;

use Moehrenzahn\Toolkit\View;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;
use Moehrenzahn\Toolkit\Api\Model\Settings\SettingInterface;

/**
 * Class Setting
 *
 * @package Moehrenzahn\Toolkit\View
 */
class Setting extends View
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
     * @param View\ViewFactory $viewFactory
     * @param string $templatePath
     * @param SettingInterface|null $setting
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        View\ViewFactory $viewFactory,
        string $templatePath = '',
        SettingInterface $setting = null
    ) {
        $this->setting = $setting;

        parent::__construct($javascript, $imageSize, $viewFactory, $templatePath);
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
