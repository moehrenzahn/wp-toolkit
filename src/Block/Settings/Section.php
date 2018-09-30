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
    /**
     * @var SectionInterface
     */
    private $section;

    /**
     * Section constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     */
    public function __construct(Javascript $javascript, ImageSize $imageSize)
    {
        $templatePath = 'Template/Settings/Section';

        parent::__construct($javascript, $imageSize, $templatePath);
    }


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
