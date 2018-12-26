<?php

namespace Toolkit\Api\Model\Settings;

use Toolkit\Block;

/**
 * Interface SettingInterface
 *
 * @package Toolkit\Api\Model\Settings
 */
interface SettingInterface
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
     * @return string
     */
    public function getDescription();

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string[]
     */
    public function getOptions();

    /**
     * @return Block
     */
    public function getBlock();
}
