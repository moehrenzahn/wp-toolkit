<?php

namespace Toolkit\Block\Settings;

use Toolkit\Api\Model\Settings\SectionInterface;
use Toolkit\Block;
use Toolkit\ImageSize;
use Toolkit\Javascript;

/**
 * Class Section
 *
 * @package Toolkit\Block\Settings
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
