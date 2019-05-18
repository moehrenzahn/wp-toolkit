<?php

namespace Moehrenzahn\Toolkit\View;

use Moehrenzahn\Toolkit\Api\Model\Settings\SectionInterface;
use Moehrenzahn\Toolkit\View;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;

/**
 * Class Settings
 *
 * @package Moehrenzahn\Toolkit\View
 */
class Settings extends View
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $page;

    /**
     * @var SectionInterface[]
     */
    private $sections = [];

    /**
     * Settings constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param ViewFactory $viewFactory
     * @param string $title
     * @param string $page
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        ViewFactory $viewFactory,
        string $title,
        string $page
    ) {
        $this->title = $title;
        $this->page = $page;
        $templatePath = TOOLKIT_TEMPLATE_FOLDER . 'Settings';

        parent::__construct($javascript, $imageSize, $viewFactory, $templatePath);
    }


    /**
     * @return SectionInterface[]
     */
    public function getSections(): array
    {
        return $this->sections;
    }

    /**
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
