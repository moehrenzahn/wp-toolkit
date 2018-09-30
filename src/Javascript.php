<?php

namespace Toolkit;

/**
 * Class Javascript
 *
 * @package Toolkit
 */
class Javascript
{
    /**
     * @var \Toolkit\Model\Javascript[]
     */
    private $models = [];

    /**
     * @param string $slug
     * @param string $filePath
     * @param string $version
     * @param array $dependencies
     */
    public function add(string $slug, string $filePath, string $version = '', array $dependencies = [])
    {
        $this->models[$slug] = new \Toolkit\Model\Javascript($slug, $filePath, $version, $dependencies);
    }

    /**
     * @return \Toolkit\Model\Javascript[]
     */
    public function getScripts(): array
    {
        return $this->models;
    }
}
