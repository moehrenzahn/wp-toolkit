<?php

namespace Toolkit;

use Toolkit\Helper\Composer;
use Toolkit\Helper\Strings;

/**
 * Generic block class for template management.
 */
class Block
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
     * Block constructor.
     *
     * @param Javascript $javascript
     * @param string $templatePath The path of a .phtml template file, relative to the composer project root.
     * @param string $templateType Template filename extension.
     *
     */
    public function __construct(Javascript $javascript, string $templatePath = '', string $templateType = 'phtml')
    {
        $this->javascript = $javascript;
        if (!$templatePath) {
            return;
        }
        $this->templatePath = $this->buildTemplatePath($templatePath, $templateType);
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
     * @param string $path
     * @param string $type
     */
    public function setTemplatePath(string $path, string $type = 'phtml')
    {
        $this->templatePath = $this->buildTemplatePath($path, $type);
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
     * @param string $type
     * @param null|\WP_Post $postObject
     * @param mixed|null $data
     */
    public function renderPartial(string $path, string $type = 'phtml', $postObject = null, $data = null)
    {
        if ($postObject) {
            $post = $postObject;
        } else {
            global $post;
        }               // make $post available in the template.
        $data = $data;   // make data object available as $data.
        $block = $this; // make the block instance avaliable as $block.

        require($this->buildTemplatePath($path, $type));
    }

    /**
     * @param string $path Template path
     * @param string $placeholder Placeholder template path
     * @param string $type Template file extension
     * @param WP_Post|null $postObject
     * @param array|null $data
     */
    public function renderLazyPartial(
        string $path,
        string $placeholder,
        string $type = 'phtml',
        $postObject = null,
        $data = null
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
                'template' => $this->buildTemplatePath($path, $type),
                'placeholder' => $this->buildTemplatePath($placeholder, $type),
            ]
        );
        $this->renderPartial(__DIR__ . 'Template/LazyPartial', 'phtml', $postObject, $data);
    }

    /**
     * Retrieve an image. A relative path will be rooted in the composer project root
     *
     * @param string $path
     * @param string $type
     * @return string
     */
    public function getImageUrl(string $path, string $type = 'jpg')
    {
        return $this->buildTemplatePath($path, $type);
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
        $classList = implode(' ', $classList);
        $url = get_the_post_thumbnail_url($postId, $size);
        $placeholderUrl = get_the_post_thumbnail_url($postId, 'placeholder');
        $lazyLoadScript = '';
        if (defined('DOING_AJAX') && DOING_AJAX) {
            $lazyLoadScript = 'onload="lazyImages.reindexImages()"';
        }
        $this->loadJsHelpers();
        $this->javascript->add(
            'lazy-images',
            __DIR__ . 'JavaScript/lazy-images',
            '',
            ['utils', 'scroll-handler']
        );
        $html = "<img $lazyLoadScript class='image-lazy loading js-only $classList' " .
            "src='$placeholderUrl' " .
            "data-full='$url' ".
            "data-placeholder='$placeholderUrl'>" .
            "<noscript><img src='$url' class='$classList'></noscript>";

        return $html;
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
     * @param string $type
     * @return string
     */
    private function buildTemplatePath(string $path, string $type)
    {
        if (!Strings::startsWith($path, '/')) {
            $path = Composer::getRootDir() . '/' . $path;
        }
        if (!Strings::endsWith($path, $type)) {
            $path .= ".$type";
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
}
