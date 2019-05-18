<?php

namespace Moehrenzahn\Toolkit\Model\AdminPage;

use Moehrenzahn\Toolkit\Api\Model\Settings\SectionInterface;
use Moehrenzahn\Toolkit\Loader;
use Moehrenzahn\Toolkit\Model\AdminPage;
use Moehrenzahn\Toolkit\View\Settings as SettingsView;

/**
 * Class Settings
 *
 * Wrapper around the Wordpress Settings API
 *
 * @package Moehrenzahn\Toolkit\Model\AdminPage
 */
class Settings extends AdminPage
{
    /**
     * @var SectionInterface[]
     */
    private $sections = [];

    /**
     * Settings constructor.
     *
     * @param Loader $loader
     * @param SettingsView $settingsView
     * @param string $title
     * @param string $slug
     * @param SectionInterface[] $sections
     */
    public function __construct(
        Loader $loader,
        SettingsView $settingsView,
        string $title,
        string $slug,
        array $sections
    ) {
        $this->sections = $sections;

        parent::__construct($loader, $title, $slug, '', 0, $settingsView);
    }

    public function register()
    {
        foreach ($this->sections as $section) {
            add_settings_section(
                $section->getId(),
                $section->getTitle(),
                [$section->view, 'renderTemplate'],
                $this->slug
            );
            foreach ($section->getSettings() as $setting) {
                add_settings_field(
                    $setting->getId(),
                    $setting->getTitle(),
                    [$setting->getView(), 'renderTemplate'],
                    $this->slug,
                    $section->getId()
                );
                register_setting(
                    $this->slug,
                    $setting->getId()
                );
            }
        }

        add_options_page(
            $this->title,
            $this->title,
            "manage_options",
            $this->slug,
            [$this->view, 'renderTemplate']
        );
    }
}
