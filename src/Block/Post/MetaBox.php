<?php

namespace Toolkit\Block\Post;

use Toolkit\Block;
use Toolkit\ImageSize;
use Toolkit\Javascript;
use Toolkit\Model\Post\PostPreference;

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
     * @param string $templatePath
     * @param array $postPreferences
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        string $templatePath,
        array $postPreferences
    ) {
        $this->postPreferences = $postPreferences;

        parent::__construct($javascript, $imageSize, $templatePath);
    }

    /**
     * @return PostPreference[]
     */
    public function getPostPreferences(): array
    {
        return $this->postPreferences;
    }
}
