<?php

namespace Moehrenzahn\Toolkit\Customizer;

use Moehrenzahn\Toolkit\Loader;

/**
 * Class CustomLogo
 */
class CustomLogo
{
    /**
     * @var \Moehrenzahn\Toolkit\Loader
     */
    private $loader;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;

    /**
     * @var bool
     */
    private $flexHeight;

    /**
     * @var bool
     */
    private $flexWidth;

    /**
     * CustomLogo constructor.
     *
     * @param Loader $loader
     * @param int $height
     * @param int $width
     * @param bool $flexHeight
     * @param bool $flexWidth
     */
    public function __construct(
        Loader $loader,
        int $height,
        int $width,
        bool $flexHeight,
        bool $flexWidth
    ) {
        $this->loader = $loader;
        $this->height = $height;
        $this->width = $width;
        $this->flexHeight = $flexHeight;
        $this->flexWidth = $flexWidth;

        $this->loader->addAction('after_setup_theme', $this, 'init');
    }

    public function init()
    {
        add_theme_support(
            'custom-logo',
            [
                'height'      => $this->height,
                'width'       => $this->width,
                'flex-height' => $this->flexHeight,
                'flex-width'  => $this->flexWidth,
            ]
        );
    }
}
