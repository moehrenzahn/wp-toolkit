<?php

namespace Toolkit\Api\Model\Settings;

/**
 * Interface SectionInterface
 *
 * @package Toolkit\Api\Model\Settings
 */
interface SectionInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return SettingInterface[]
     */
    public function getSettings();

    /**
     * @return string
     */
    public function getDescription();
}
