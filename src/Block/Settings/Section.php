<?php

namespace Toolkit\Block\Settings;

use Toolkit\Block;
use Toolkit\AdminPage\Settings\Section as SectionModel;

class Section extends Block
{
    /**
     * @var \Toolkit\AdminPage\Settings\Section
     */
    private $section;

    /**
     * Section constructor.
     *
     * @param SectionModel $section
     */
    public function __construct(SectionModel $section = null)
    {
        $this->section = $section;

        parent::__construct('Wordpress/Template/Settings/Section.phtml');
    }

    /**
     * @return SectionModel
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param SectionModel $section
     */
    public function setSection(SectionModel $section)
    {
        $this->section = $section;
    }
}
