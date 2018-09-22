<?php

namespace Toolkit;

/**
 * Class ImageSize
 *
 * @package Toolkit
 */
class ImageSize
{
    /**
     * @param string $name
     * @param int $width
     * @param int|null $height
     * @param bool $crop
     */
    public function add(string $name, int $width, $height = null, bool $crop = false)
    {
        add_image_size($name, $width, $height, $crop);
    }
}
