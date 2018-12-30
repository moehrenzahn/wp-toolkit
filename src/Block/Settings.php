<?php

namespace Moehrenzahn\Toolkit\Block;

use Moehrenzahn\Toolkit\Api\Model\Settings\SectionInterface;
use Moehrenzahn\Toolkit\Block;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;

class Settings extends Block
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
     * @param BlockFactory $blockFactory
     * @param string $title
     * @param string $page
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        BlockFactory $blockFactory,
        string $title,
        string $page
    ) {
        $this->title = $title;
        $this->page = $page;
        $templatePath = TOOLKIT_TEMPLATE_FOLDER . 'Settings';

        parent::__construct($javascript, $imageSize, $blockFactory, $templatePath);
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
