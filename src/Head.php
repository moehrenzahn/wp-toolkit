<?php

namespace Toolkit;

use Toolkit\Block\BlockFactory;

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
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * Head constructor.
     *
     * @param Loader $loader
     * @param BlockFactory $blockFactory
     */
    public function __construct(Loader $loader, BlockFactory $blockFactory)
    {
        $this->loader = $loader;
        $this->blockFactory = $blockFactory;
    }

    /**
     * @param string $templatePath Full path to the template file to render.
     * @param string $blockClass Full class name of a Api\BlockInterface implementation
     */
    public function addTemplate(string $templatePath, string $blockClass = Block::class)
    {
        $block = $this->blockFactory->create($templatePath, $blockClass);
        $this->loader->addAction('wp_head', $block, 'renderTemplate');
    }
}
