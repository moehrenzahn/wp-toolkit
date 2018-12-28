<?php

namespace Toolkit\AdminPage;

use Toolkit\Api\Model\Settings\SettingInterface;
use Toolkit\Block\BlockFactory;
use Toolkit\Block\Settings\Section;

/**
 * Class SettingsSectionBuilder
 *
 * @package Toolkit\AdminPage\SettingsSectionBuilder
 */
class SettingsSectionBuilder
{
    const SETTING_TYPE_BOOLEAN = 'Boolean';
    const SETTING_TYPE_BUTTON = 'Button';
    const SETTING_TYPE_MEDIA = 'Media';
    const SETTING_TYPE_SELECT = 'Select';
    const SETTING_TYPE_TEXT = 'Text';
    const SETTING_TYPE_TEXTAREA = 'Textarea';

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * @var SettingBuilder
     */
    private $settingBuilder;

    /**
     * @var SettingInterface[]
     */
    private $settings;

    /**
     * SettingsSectionBuilder constructor.
     *
     * @param BlockFactory $blockFactory
     * @param SettingBuilder $settingBuilder
     */
    public function __construct(BlockFactory $blockFactory, SettingBuilder $settingBuilder)
    {
        $this->toolkit = $blockFactory;
        $this->settingBuilder = $settingBuilder;
    }

    /**
     * @param string $id
     * @param string $title
     * @param string $type
     * @param string $description
     * @param array $options
     */
    public function addSetting(
        string $id,
        string $title,
        string $type,
        string $description = '',
        array $options = []
    ) {
        $this->settings[] = $this->settingBuilder->create($id, $title, $type, $description, $options);
    }

    /**
     * @param string $id
     * @param string $title
     * @param string $description
     * @return \Toolkit\Model\AdminPage\Settings\Section
     */
    public function create(
        string $id,
        string $title,
        string $description = ''
    ) {
        /** @var Section $block */
        $block = $this->toolkit->create(
            TOOLKIT_TEMPLATE_FOLDER . Section::DEFAULT_TEMPLATE,
            Section::class
        );
        $section = new \Toolkit\Model\AdminPage\Settings\Section($id, $title, $this->settings, $block, $description);

        $this->resetData();

        return $section;
    }

    private function resetData()
    {
        $this->settings = [];
    }
}
