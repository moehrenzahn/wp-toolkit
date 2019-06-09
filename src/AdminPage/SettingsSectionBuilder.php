<?php

namespace Moehrenzahn\Toolkit\AdminPage;

use Moehrenzahn\Toolkit\Api\Model\Settings\SettingInterface;
use Moehrenzahn\Toolkit\Javascript;
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
     * @var Javascript
     */
    private $javaScript;

    /**
     * @var SettingInterface[]
     */
    private $settings;

    /**
     * SettingsSectionBuilder constructor.
     *
     * @param ViewFactory $viewFactory
     * @param SettingBuilder $settingBuilder
     * @param Javascript $javaScript
     */
    public function __construct(
        ViewFactory $viewFactory,
        SettingBuilder $settingBuilder,
        Javascript $javaScript
    ) {
        $this->viewFactory = $viewFactory;
        $this->settingBuilder = $settingBuilder;
        $this->javaScript = $javaScript;
    }

    /**
     * @param string $id        The unique ID and slug of the setting.
     * @param string $title     The setting title.
     * @param string $type      The setting input type, use SettingsSectionBuilder::SETTING_TYPE_*.
     * @param string $description   The setting description.
     * @param array $options    The options array for input type SETTING_TYPE_SELECT
     * @param string[] $depends Control which input id's must have a value for the setting to appear.
     */
    public function addSetting(
        string $id,
        string $title,
        string $type,
        string $description = '',
        array $options = [],
        array $depends = []
    ) {
        $this->settings[] = $this->settingBuilder->create(
            $id,
            $title,
            $type,
            $description,
            $options,
            $depends
        );
    }

    /**
     * @param string $id            The unique id of the section.
     * @param string $title         The section title.
     * @param string $description   The section description.
     * @param string[] $depends     Control which input id's must have a value for the section to appear.
     * @return \Moehrenzahn\Toolkit\Model\AdminPage\Settings\Section
     */
    public function create(
        string $id,
        string $title,
        string $description = '',
        array $depends = []
    ) {
        if ($depends) {
            $this->javaScript->add(
                'config-depends',
                TOOLKIT_PUB_URL . 'js/config-depends',
                '1.0.0'
            );
        }
        /** @var Section $view */
        $view = $this->viewFactory->create(
            TOOLKIT_TEMPLATE_FOLDER . Section::DEFAULT_TEMPLATE,
            Section::class
        );
        $view->setDepends($depends);
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
