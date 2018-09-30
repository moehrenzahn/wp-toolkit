<?php

namespace Toolkit\Model\AdminPage;

use Toolkit\Api\Model\Settings\SectionInterface;
use Toolkit\Loader;
use Toolkit\Model\AdminPage;
use Toolkit\Block\Settings as SettingsBlock;

/**
 * Class Settings
 *
 * Wrapper around the Wordpress Settings API
 *
 * @package Toolkit\Model\AdminPage
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
     * @param SettingsBlock $settingsBlock
     * @param string $title
     * @param string $slug
     * @param SectionInterface[] $sections
     */
    public function __construct(
        Loader $loader,
        SettingsBlock $settingsBlock,
        string $title,
        string $slug,
        array $sections
    ) {
        $this->sections = $sections;

        parent::__construct($loader, $title, $slug, '', 0, $settingsBlock);
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
