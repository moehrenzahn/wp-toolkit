<?php

namespace Moehrenzahn\Toolkit\AdminPage;

use Moehrenzahn\Toolkit\Api\Model\Settings\SettingInterface;
use Moehrenzahn\Toolkit\View\ViewFactory;
use Moehrenzahn\Toolkit\View\Settings\Section;

/**
 * Class SettingsSectionBuilder
 *
 * @package Moehrenzahn\Toolkit\AdminPage\SettingsSectionBuilder
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
     * @var ViewFactory
     */
    private $viewFactory;

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
     * @param ViewFactory $viewFactory
     * @param SettingBuilder $settingBuilder
     */
    public function __construct(ViewFactory $viewFactory, SettingBuilder $settingBuilder)
    {
        $this->viewFactory = $viewFactory;
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
     * @return \Moehrenzahn\Toolkit\Model\AdminPage\Settings\Section
     */
    public function create(
        string $id,
        string $title,
        string $description = ''
    ) {
        /** @var Section $view */
        $view = $this->viewFactory->create(
            TOOLKIT_TEMPLATE_FOLDER . Section::DEFAULT_TEMPLATE,
            Section::class
        );
        $section = new \Moehrenzahn\Toolkit\Model\AdminPage\Settings\Section(
            $id,
            $title,
            $this->settings,
            $view,
            $description
        );

        $this->resetData();

        return $section;
    }

    private function resetData()
    {
        $this->settings = [];
    }
}
