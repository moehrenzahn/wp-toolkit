<?php

namespace Toolkit;

/**
 * Class Stylesheet
 *
 * @package Toolkit
 */
class Stylesheet
{
    /**
     * @var \Toolkit\Model\Stylesheet[]
     */
    private $models;

    /**
     * @param string $slug
     * @param string $filePath
     * @param string $version
     */
    public function add(string $slug, string $filePath, string $version = '1.0.0')
    {
        $this->models[] = new \Toolkit\Model\Stylesheet($slug, $filePath, $version);
    }

    /**
     * @return \Toolkit\Model\Stylesheet[]
     */
    public function getScripts(): array
    {
        return $this->models;
    }
}
