<?php

namespace Toolkit\AdminPage;

use Toolkit\Api\Client;
use Toolkit\Api\Model\Settings\SettingInterface;
use Toolkit\Model\AdminPage\Settings\Setting;

/**
 * Class SettingBuilder
 *
 * This class is used to build SettingInterface instances. It should only be used via SettingsSectionBuilder.
 *
 * @internal
 * @package Toolkit\AdminPage\SettingBuilder
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
     * @var Client
     */
    private $toolkit;

    /**
     * SettingBuilder constructor.
     *
     * @param Client $toolkit
     */
    public function __construct(Client $toolkit)
    {
        $this->toolkit = $toolkit;
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
        /** @var \Toolkit\Block\Settings\Setting $block */
        $block = $this->toolkit->createBlock(
            $template,
            \Toolkit\Block\Settings\Setting::class,
            []
        );
        /** @var SettingInterface $setting */
        $setting = new $settingModel($this->toolkit->getConfigAccessor(), $id, $title, $description, $options, $block);

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

        if (class_exists("\Toolkit\Block\Settings\Setting\\$type")) {
            return "\Toolkit\Block\Settings\Setting\\$type";
        }

        return Setting::class;
    }
}
