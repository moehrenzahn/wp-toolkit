<?php

namespace Moehrenzahn\Toolkit\Block\Post;

use Moehrenzahn\Toolkit\Block;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;
use Moehrenzahn\Toolkit\Model\Post\PostPreference;

/**
 * Class MetaBox
 *
 * @package Toolkit
 */
class MetaBox extends Block
{
    /**
     * @var PostPreference[]
     */
    private $postPreferences;

    /**
     * MetaBox constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param Block\BlockFactory $blockFactory
     * @param string $templatePath
     * @param array $postPreferences
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        Block\BlockFactory $blockFactory,
        string $templatePath,
        array $postPreferences
    ) {
        $this->postPreferences = $postPreferences;

        parent::__construct($javascript, $imageSize, $blockFactory, $templatePath);
    }

    /**
     * @return PostPreference[]
     */
    public function getPostPreferences(): array
    {
        return $this->postPreferences;
    }
}
