<?php

namespace Moehrenzahn\Toolkit\AdminPage;

use Moehrenzahn\Toolkit\Api\Model\Settings\SettingInterface;
use Moehrenzahn\Toolkit\View\ViewFactory;
use Moehrenzahn\Toolkit\ConfigAccessor;
use Moehrenzahn\Toolkit\Model\AdminPage\Settings\Setting;

/**
 * Class SettingBuilder
 *
 * This class is used to build SettingInterface instances. It should only be used via SettingsSectionBuilder.
 *
 * @internal
 * @package Moehrenzahn\Toolkit\AdminPage\SettingBuilder
 */
class SettingBuilder
{
    const SETTINGS = [
        SettingsSectionBuilder::SETTING_TYPE_BOOLEAN,
        SettingsSectionBuilder::SETTING_TYPE_BUTTON,
        SettingsSectionBuilder::SETTING_TYPE_MEDIA,
        SettingsSectionBuilder::SETTING_TYPE_SELECT,
        SettingsSectionBuilder::SETTING_TYPE_TEXT,
        SettingsSectionBuilder::SETTING_TYPE_TEXTAREA,
    ];

    /**
     * @var ConfigAccessor
     */
    private $configAccessor;

    /**
     * @var ViewFactory
     */
    private $viewFactory;

    /**
     * SettingBuilder constructor.
     *
     * @param ConfigAccessor $configAccessor
     * @param ViewFactory $viewFactory
     */
    public function __construct(ConfigAccessor $configAccessor, ViewFactory $viewFactory)
    {
        $this->configAccessor = $configAccessor;
        $this->viewFactory = $viewFactory;
    }

    /**
     * @param string $id
     * @param string $title
     * @param string $type
     * @param string $description
     * @param array $options
     * @return SettingInterface
     */
    public function create(
        string $id,
        string $title,
        string $type,
        string $description = '',
        array $options = []
    ) {
        $settingModel = $this->getModelForType($type);
        $template = $this->getTemplateForType($type);
        /** @var \Moehrenzahn\Toolkit\View\Settings\Setting $view */
        $view = $this->viewFactory->create(
            $template,
            \Moehrenzahn\Toolkit\View\Settings\Setting::class,
            []
        );
        /** @var SettingInterface $setting */
        $setting = new $settingModel($this->configAccessor, $id, $title, $description, $options, $view);

        return $setting;
    }

    /**
     * @param string $type
     * @return string
     */
    private function getTemplateForType(string $type)
    {
        if (in_array($type, self::SETTINGS)) {
            return TOOLKIT_TEMPLATE_FOLDER . 'Settings/Setting/' . $type;
        }

        return $type;
    }

    /**
     * @param string $type
     * @return string
     */
    private function getModelForType(string $type)
    {
        if (class_exists($type)) {
            return $type;
        }

        if (class_exists("\Moehrenzahn\Toolkit\View\Settings\Setting\\$type")) {
            return "\Moehrenzahn\Toolkit\View\Settings\Setting\\$type";
        }

        return Setting::class;
    }
}
