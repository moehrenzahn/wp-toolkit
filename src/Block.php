<?php

namespace Toolkit;

use Toolkit\Helper\Strings;

/**
 * Generic block class for template management.
 */
class Block
{
    const TEMPLATE_TYPE = '.phtml';

    /**
     * @var string
     */
    protected $templatePath;

    /**
     * Block constructor.
     *
     * @param string $templatePath
     */
    public function __construct($templatePath = null)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * Output template into output
     */
    public function renderTemplate()
    {
        if (!$this->templatePath) {
            return;
        }
        if (!Strings::endsWith($this->templatePath, self::TEMPLATE_TYPE)) {
            $this->templatePath .= self::TEMPLATE_TYPE;
        }
        $block = $this; // make the block instance avaliable as $block in the template
        require(__DIR__ . '/../' . $this->templatePath); // relative to library dir
    }

    /**
     * @param string $path
     */
    public function setTemplatePath($path)
    {
        $this->templatePath = $path;
    }

    /**
     * Output template using native get_template_part function
     *
     * @param $slug
     * @param \WP_Post|null $postObject
     */
    public function renderTemplatePart($slug, $postObject = null)
    {
        if ($postObject) {
            global $post;
            $post = $postObject;
        }
        get_template_part($slug);
    }

    /**
     * Retrieve Template html
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
     * @param $path
     * @param null|\WP_Post $postObject
     * @param mixed|null $data
     * @return string
     */
    public function getPartial($path, $postObject = null, $data = null)
    {
        ob_start();
        $this->renderPartial($path, $postObject, $data);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    /**
     * @param string $name
     * @param string $type
     * @return string
     */
    public function getImage($name, $type = 'jpg')
    {
        return get_template_directory_uri() . "/library/Template/Images/$name.$type";
    }

    public function getLazyThumbnail(int $postId, string $size, $classList = [])
    {
        $classList = implode(' ', $classList);
        $url = get_the_post_thumbnail_url($postId, $size);
        $placeholderUrl = get_the_post_thumbnail_url($postId, 'placeholder');
        $lazyLoadScript = '';
        if (defined('DOING_AJAX') && DOING_AJAX) {
            $lazyLoadScript = 'onload="lazyImages.reindexImages()"';
        }
        $html = "<img $lazyLoadScript class='image-lazy loading js-only $classList' " .
            "src='$placeholderUrl' " .
            "data-full='$url' ".
            "data-placeholder='$placeholderUrl'>" .
            "<noscript><img src='$url' class='$classList'></noscript>";
        return $html;
    }

    /**
     * @param $path
     * @param null|\WP_Post $postObject
     * @param mixed|null $data
     */
    public function renderPartial($path, $postObject = null, $data = null)
    {
        global $post;
        if ($postObject) {
            $post = $postObject;
        }
        if (!Strings::endsWith($path, self::TEMPLATE_TYPE)) {
            $path .= self::TEMPLATE_TYPE;
        }

        $block = $this; // make the block instance avaliable as $block in the template
        require(__DIR__ . '/../Template/' . $path);
    }

    /**
     * Render the page header. Use only once per request
     */
    public function renderHeader()
    {
        $this->renderPartial('../Wordpress/Template/Head');
        $this->renderPartial('../Wordpress/Template/Header');
    }

    /**
     * Render the page footer. Use only once per request
     */
    public function renderFooter()
    {
        $this->renderPartial('../Wordpress/Template/Footer');
    }
}
