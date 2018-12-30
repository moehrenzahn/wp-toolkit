<?php

namespace Moehrenzahn\Toolkit;

/**
 * Class Javascript
 *
 * @package Toolkit
 */
class Javascript
{
    /**
     * @var \Moehrenzahn\Toolkit\Model\Javascript[]
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
        $this->models[$slug] = new \Moehrenzahn\Toolkit\Model\Javascript($slug, $filePath, $version, $dependencies);
    }

    /**
     * @return \Moehrenzahn\Toolkit\Model\Javascript[]
     */
    public function getScripts(): array
    {
        return $this->models;
    }
}
