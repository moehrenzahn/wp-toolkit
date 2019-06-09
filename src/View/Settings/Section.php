<?php

namespace Moehrenzahn\Toolkit\View\Settings;

use Moehrenzahn\Toolkit\Api\Model\Settings\SectionInterface;
use Moehrenzahn\Toolkit\View;

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
     * @var string[]
     */
    private $depends;

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

    /**
     * @return string[]
     */
    public function getDepends(): array
    {
        return $this->depends;
    }

    /**
     * @param string[] $depends
     */
    public function setDepends(array $depends)
    {
        $this->depends = $depends;
    }
}
