<?php

namespace Moehrenzahn\Toolkit\Api\Model\Settings;

use Moehrenzahn\Toolkit\View;

/**
 * Interface SettingInterface
 *
 * @package Moehrenzahn\Toolkit\Api\Model\Settings
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
     * @return View
     */
    public function getView();
}
