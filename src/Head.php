<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\View\ViewFactory;

/**
 * Class Head
 *
 * @package Toolkit
 */
class Head
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var ViewFactory
     */
    private $viewFactory;

    /**
     * Head constructor.
     *
     * @param Loader $loader
     * @param ViewFactory $viewFactory
     */
    public function __construct(Loader $loader, ViewFactory $viewFactory)
    {
        $this->loader = $loader;
        $this->viewFactory = $viewFactory;
    }

    /**
     * @param string $templatePath Full path to the template file to render.
     * @param string $viewClass Full class name of a Api\ViewInterface implementation
     */
    public function addTemplate(string $templatePath, string $viewClass = View::class)
    {
        $view = $this->viewFactory->create($templatePath, $viewClass);
        $this->loader->addAction('wp_head', $view, 'renderTemplate');
    }
}
