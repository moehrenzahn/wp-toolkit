<?php

namespace Toolkit\AdminPage;

use Toolkit\Loader;
use Toolkit\AdminPage;
use Toolkit\Block\Settings as SettingsBlock;

/**
 * Class Settings
 *
 * Wrapper around the Wordpress Settings API
 *
 * @package Devotionalium
 */
class Settings extends AdminPage
{
    /**
     * @var Settings\Section[]
     */
    private $sections;

    /**
     * Settings constructor.
     *
     * @param Loader $loader
     * @param string $title
     * @param string $slug
     * @param Settings\Section[] $sections
     */
    public function __construct($loader, $title, $slug, $sections)
    {
        $this->sections = $sections;
        $block = new SettingsBlock($title, $slug);

        parent::__construct($loader, $title, $slug, '', 0, $block);
    }

    public function register()
    {
        foreach ($this->sections as $section) {
            add_settings_section(
                $section->getId(),
                $section->getTitle(),
                [$section->block, 'renderTemplate'],
                $this->slug
            );
            foreach ($section->getSettings() as $setting) {
                add_settings_field(
                    $setting->getId(),
                    $setting->getTitle(),
                    [$setting->block, 'renderTemplate'],
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
            [$this, 'renderContent']
        );
    }
}
