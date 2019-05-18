<?php

namespace Moehrenzahn\Toolkit\View\Settings;

use Moehrenzahn\Toolkit\Api\Model\Settings\SectionInterface;
use Moehrenzahn\Toolkit\View;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;

/**
 * Class Section
 *
 * @package Moehrenzahn\Toolkit\View\Settings
 */
class Section extends View
{
    const DEFAULT_TEMPLATE = 'Settings/Section';

    /**
     * @var SectionInterface
     */
    private $section;

    /**
     * @return SectionInterface
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param SectionInterface $section
     */
    public function setSection(SectionInterface $section)
    {
        $this->section = $section;
    }
}
