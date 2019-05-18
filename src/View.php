<?php

namespace Moehrenzahn\Toolkit;

use Moehrenzahn\Toolkit\Api\ViewInterface;
use Moehrenzahn\Toolkit\View\ViewFactory;
use Moehrenzahn\Toolkit\Helper\Browser;
use Moehrenzahn\Toolkit\Helper\Request;
use Moehrenzahn\Toolkit\Helper\Strings;

/**
 * Class View
 *
 * Generic view class for template management.
 *
 * @package Toolkit
 */
class View implements ViewInterface
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
     * @var ViewFactory
     */
    private $viewFactory;

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
     * View constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param ViewFactory $viewFactory
     * @param string $templatePath The path of a template file, relative to the composer project root.
     * @param \WP_Post|null $post
     * @param mixed[] $data
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        ViewFactory $viewFactory,
        string $templatePath = '',
        \WP_Post $post = null,
        array $data = []
    ) {
        $this->javascript = $javascript;
        $this->imageSize = $imageSize;
        $this->viewFactory = $viewFactory;
        $this->post = $post;
        $this->data = $data;
        if ($templatePath) {
            $this->templatePath = $this->buildTemplatePath($templatePath);
        }

        /**
         * @TODO: Move this somewhere more appropriate.
         */
        $this->loadJsHelpers();
    }

    /**
     * Output template into output
     */
    public function renderTemplate()
    {
        if (!$this->templatePath) {
            return;
        }

        $view = $this; // make the view instance avaliable as $view in the template
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
     * Retrieve view template HTML
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
        /** @deprecated Use $view->getData to read data in templates. */
        if ($data) {
            $this->data = $data;
        }
        $view = $this; // make the view instance avaliable as $view.
        require($this->buildTemplatePath($path));
    }

    /**
     * @param string $path
     * @param string $placeholder
     * @param \WP_Post|null $postObject
     * @param mixed[] $data
     * @param string $viewClass
     */
    public function renderLazyPartial(
        string $path,
        string $placeholder,
        $postObject = null,
        $data = [],
        $viewClass = ''
    ) {
        $viewClass = $viewClass ?: static::class;

        if (Browser::isInternetExplorer()) {
            if ($viewClass !== static::class) {
                $view = $this->viewFactory->create('', $viewClass);
                $view->renderPartial($path, $postObject, $data);
            } else {
                $this->renderPartial($path, $postObject, $data);
            }
            return;
        }

        $this->javascript->add(
            'ajax-load-template',
            TOOLKIT_PUB_URL . 'js/ajax/load-template',
            '',
            ['toolkit-utils', 'jquery', 'scroll-handler']
        );
        wp_localize_script(
            'ajax-load-template',
            'ToolkitTemplateAjaxData',
            ['ajaxUrl' => admin_url('admin-ajax.php')]
        );

        $data['template'] = $this->buildTemplatePath($path);
        $data['placeholder'] = $this->buildTemplatePath($placeholder);
        $data['viewClass'] = $viewClass;
        $data['postId'] = $postObject->ID ?? 0;

        $this->renderPartial(TOOLKIT_TEMPLATE_FOLDER . 'LazyPartial', $postObject, $data);
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
        $this->imageSize->add('placeholder', 10);
        $lazyLoadScript = Request::isAjax() ? 'onload="lazyImages.reindexImages()"' : '';
        $data = [
            'url' => get_the_post_thumbnail_url($postId, $size),
            'placeholderUrl' => get_the_post_thumbnail_url($postId, 'placeholder'),
            'classList' => implode(' ', $classList),
            'lazyLoadScript' => $lazyLoadScript,
        ];

        if (Browser::isInternetExplorer()) {
            /** Do not do any javascript magic if in IE */
            return $this->getPartial(TOOLKIT_TEMPLATE_FOLDER . 'LazyImageFallback', null, $data);
        }

        return $this->getPartial(TOOLKIT_TEMPLATE_FOLDER . 'LazyImage', null, $data);
    }

    /**
     * Retrieve an image by relative path from the template directory uri.
     *
     * @param string $path
     * @return string
     */
    public function getImageUrl(string $path)
    {
        if (!Strings::startsWith($path, '/')) {
            $path = '/' . $path;
        }

        return get_template_directory_uri() . $this->buildTemplatePath($path);
    }

    /**
     * Render the native WordPress page header template. Use only once per request.
     *
     * @param string|null $name Calls for header-name.php.
     */
    public function renderHeader(string $name = null)
    {
        $this->renderPartial(TOOLKIT_TEMPLATE_FOLDER . 'Head.phtml');
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
        $pathParts = explode('/', $path);
        if (!Strings::contains(array_pop($pathParts), '.')) {
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
            'toolkit-utils',
            TOOLKIT_PUB_URL . 'js/utils'
        );
        if (is_admin()) {
            $this->javascript->add(
                'media-selector',
                TOOLKIT_PUB_URL. 'js/media-selector',
                '1.0',
                ['jquery']
            );
        } else {
            $this->javascript->add(
                'scroll-handler',
                TOOLKIT_PUB_URL . 'js/scroll-handler'
            );
            $this->javascript->add(
                'lazy-images',
                TOOLKIT_PUB_URL . 'js/lazy-images',
                '',
                ['toolkit-utils', 'scroll-handler']
            );
        }
    }

    /**
     * @return \WP_Post|null
     */
    public function getPost()
    {
        return $this->post ?? get_post();
    }

    /**
     * @param \WP_Post $post
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
