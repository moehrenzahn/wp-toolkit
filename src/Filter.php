<?php

namespace Toolkit;

use Toolkit\Api\FilterInterface;

/**
 * Class Filter
 *
 * @package Toolkit
 */
class Filter
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * Filter constructor.
     *
     * @param Loader $loader
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param FilterInterface $filter
     * @param bool $postsOnly
     */
    public function addContentFilter(FilterInterface $filter, bool $postsOnly = false)
    {
        if ($postsOnly) {
            $this->loader->addFilter(
                'the_content',
                null,
                function (string $content) use ($filter, $postsOnly) {
                    $post = get_post();
                    if (!$post || $post->post_type !== 'post') {
                        return $content;
                    }
                    return $filter->filter($content);
                }
            );
        } else {
            $this->loader->addFilter('the_content', $filter, 'filter');
        }
    }

    /**
     * @param FilterInterface $filter
     * @param bool $postsOnly
     */
    public function addContentSaveFilter(FilterInterface $filter, bool $postsOnly = false)
    {
        $this->loader->addFilter(
            'content_save_pre',
            null,
            function (string $content) use ($filter, $postsOnly) {
                if ($postsOnly) {
                    $post = get_post();
                    if (!$post || $post->post_type !== 'post') {
                        return $content;
                    }
                }
                return $filter->filter($content);
            }
        );
    }

    /**
     * @param FilterInterface $filter
     */
    public function addRssFilter(FilterInterface $filter)
    {
        $this->loader->addFilter('the_content_feed', $filter, 'filter');
    }
}
