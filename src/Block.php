<?php

namespace Toolkit;

use Toolkit\Api\BlockInterface;
use Toolkit\Helper\Strings;

/**
 * Class Block
 *
 * Generic block class for template management.
 *
 * @package Toolkit
 */
class Block implements BlockInterface
{
    /**
     * @var string
     */
    protected $templatePath;

    /**
     * @var Javascript
     */
    private $javascript;

    /**
     * @var ImageSize
     */
    private $imageSize;

    /**
     * @var \WP_Post|null
     */
    private $post;

    /**
     * @var mixed[]
     */
    private $data;

    /**
     * @var string
     */
    private $defaultTemplateExtension = 'phtml';

    /**
     * Block constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param string $templatePath The path of a template file, relative to the composer project root.
     * @param \WP_Post|null $post
     * @param mixed[] $data
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        string $templatePath,
        \WP_Post $post = null,
        array $data = []
    ) {
        $this->javascript = $javascript;
        $this->imageSize = $imageSize;
        $this->post = $post;
        $this->data = $data;
        if ($templatePath) {
            $this->templatePath = $this->buildTemplatePath($templatePath);
        }
    }

    /**
     * Output template into output
     */
    public function renderTemplate()
    {
        if (!$this->templatePath) {
            return;
        }

        $block = $this; // make the block instance avaliable as $block in the template
        require($this->templatePath);
    }

    /**
     * Output a template by slug using WordPress get_template_part function
     *
     * @param $slug
     * @param \WP_Post|null $postObject
     */
    public function renderTemplatePart(string $slug, $postObject = null)
    {
        if ($postObject) {
            global $post;
            $post = $postObject;
        }
        get_template_part($slug);
    }

    /**
     * Retrieve block template HTML
     *
     * @return string
     */
    public function getHtml()
    {
        ob_start();
        $this->renderTemplate();
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    /**
     * Retrieve HTML of a template part.
     *
     * @param string $path
     * @param null|\WP_Post $postObject
     * @param mixed|null $data
     * @return string
     */
    public function getPartial(string $path, $postObject = null, $data = null)
    {
        ob_start();
        $this->renderPartial($path, $postObject, $data);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    /**
     * Render a template part.
     *
     * @param string $path
     * @param null|\WP_Post $postObject
     * @param mixed|null $data
     */
    public function renderPartial(string $path, $postObject = null, $data = null)
    {
        global $post;
        if ($postObject) {
            $this->post = $postObject;
            $post = $postObject;
        }
        if ($data) {
            $this->data = $data;
        }
        $block = $this; // make the block instance avaliable as $block.

        require($this->buildTemplatePath($path));
    }

    /**
     * @param string $path Template path
     * @param string $placeholder Placeholder template path
     * @param \WP_Post|null $postObject
     * @param mixed[] $data
     */
    public function renderLazyPartial(
        string $path,
        string $placeholder,
        $postObject = null,
        $data = []
    ) {
        $this->loadJsHelpers();
        $this->javascript->add(
            'ajax-load-template',
            __DIR__ . 'JavaScript/ajax/load-template',
            '',
            ['utils', 'jquery', 'scroll-handler']
        );

        $data = array_merge(
            $data,
            [
                'template' => $this->buildTemplatePath($path),
                'placeholder' => $this->buildTemplatePath($placeholder),
            ]
        );
        $this->renderPartial(__DIR__ . '/Template/LazyPartial', $postObject, $data);
    }

    /**
     * Retrieve an image. A relative path will be rooted in the composer project root
     *
     * @param string $path
     * @return string
     */
    public function getImageUrl(string $path)
    {
        return $this->buildTemplatePath($path);
    }

    /**
     * Get a posts thumbnail image as lazy-loaded <img> tag.
     *
     * @param int $postId
     * @param string $size A WordPress image size class
     * @param array $classList List of HTML classes
     * @return string
     */
    public function getLazyThumbnail(int $postId, string $size, array $classList = [])
    {
        $this->loadJsHelpers();
        $this->javascript->add(
            'lazy-images',
            __DIR__ . 'JavaScript/lazy-images',
            '',
            ['utils', 'scroll-handler']
        );

        $placeholderSize = 'placeholder';
        $this->imageSize->add($placeholderSize, 10);
        $lazyLoadScript = '';
        if (defined('DOING_AJAX') && DOING_AJAX) {
            $lazyLoadScript = 'onload="lazyImages.reindexImages()"';
        }
        $data = [
            'url' => get_the_post_thumbnail_url($postId, $size),
            'placeholderUrl' => get_the_post_thumbnail_url($postId, $placeholderSize),
            'classList' => implode(' ', $classList),
            'lazyLoadScript' => $lazyLoadScript,
        ];

        return $this->getPartial(__DIR__ . '/Template/LazyImage', null, $data);
    }

    /**
     * Render the native WordPress page header template. Use only once per request.
     *
     * @param string|null $name Calls for header-name.php.
     */
    public function renderHeader(string $name = null)
    {
        $this->renderPartial(__DIR__ . '/Template/Head.phtml');
        get_header($name);
    }

    /**
     * Render the native WordPress page footer template.
     *
     * @param string $name Calls for footer-name.php.
     */
    public function renderFooter(string $name = null)
    {
        get_footer($name);
    }

    /**
     * @param string $path
     * @return string
     */
    private function buildTemplatePath(string $path)
    {
        if (!Strings::contains($path, '.')) {
            $path .= ".$this->defaultTemplateExtension";
        }

        return $path;
    }

    /**
     * Shortcut to load common js files.
     */
    private function loadJsHelpers()
    {
        $this->javascript->add(
            'utils',
            __DIR__ . 'JavaScript/utils'
        );
        $this->javascript->add(
            'scroll-handler',
            __DIR__ . 'JavaScript/scroll-handler'
        );
    }

    /**
     * @return \WP_Post
     */
    public function getPost(): \WP_Post
    {
        return $this->post ?? get_post();
    }

    /**
     * @param null|\WP_Post $post
     */
    public function setPost(\WP_Post $post)
    {
        $this->post = $post;
    }

    /**
     * @param string|null $index
     * @return mixed
     */
    public function getData(string $index = null)
    {
        if ($index && isset($this->data[$index])) {
            return $this->data[$index];
        }

        return $this->data;
    }

    /**
     * @param mixed[] $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $extension
     */
    public function setDefaultTemplateExtension(string $extension)
    {
        $this->defaultTemplateExtension = $extension;
    }
}
