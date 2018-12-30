<?php

namespace Moehrenzahn\Toolkit\Block\Settings;

use Moehrenzahn\Toolkit\Api\Model\Settings\SectionInterface;
use Moehrenzahn\Toolkit\Block;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;

/**
 * Class Section
 *
 * @package Moehrenzahn\Toolkit\Block\Settings
 */
class Section extends Block
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
