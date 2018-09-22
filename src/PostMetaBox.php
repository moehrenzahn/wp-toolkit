<?php

namespace Toolkit;

use Toolkit\Loader;

/**
 * Class PostMetaBox
 *
 * @package Toolkit\PostMetaBox
 */
class PostMetaBox
{
    const SCREEN_NAME = 'post';

    const HOOK = 'add_meta_boxes';

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var Block
     */
    private $block;

    /**
     * @var Loader
     */
    protected $loader;


    /**
     * PostMetaBox constructor.
     *
     * @param string $title
     * @param Block $block
     * @param Loader $loader
     */
    public function __construct($title, Block $block, Loader $loader)
    {
        $this->title = $title;
        $this->slug = $this->generateSlug($title);
        $this->block = $block;
        $this->loader = $loader;

        $this->loader->addAction(self::HOOK, $this, 'register');
    }

    /**
     * Register backend page with wordpress
     */
    public function register()
    {
        add_meta_box(
            $this->slug,
            $this->title,
            [$this, 'renderTemplate'],
            self::SCREEN_NAME,
            'side',
            'high'
        );
    }

    public function renderTemplate()
    {
        $this->block->renderTemplate();
    }

    /**
     * @param $title
     * @return mixed|string
     */
    private function generateSlug($title)
    {
        $result = strtolower($title);
        $result = str_replace(' ', '_', $result);

        return $result;
    }
}
