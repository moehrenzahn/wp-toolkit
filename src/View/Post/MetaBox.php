<?php

namespace Moehrenzahn\Toolkit\View\Post;

use Moehrenzahn\Toolkit\View;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;
use Moehrenzahn\Toolkit\Model\Post\PostPreference;

/**
 * Class MetaBox
 *
 * @package Toolkit
 */
class MetaBox extends View
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
     * @param View\ViewFactory $viewFactory
     * @param string $templatePath
     * @param array $postPreferences
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        View\ViewFactory $viewFactory,
        string $templatePath,
        array $postPreferences
    ) {
        $this->postPreferences = $postPreferences;

        parent::__construct($javascript, $imageSize, $viewFactory, $templatePath);
    }

    /**
     * @return PostPreference[]
     */
    public function getPostPreferences(): array
    {
        return $this->postPreferences;
    }
}
