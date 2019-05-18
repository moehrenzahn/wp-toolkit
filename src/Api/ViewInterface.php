<?php

namespace Moehrenzahn\Toolkit\Api;

/**
 * Interface ViewInterface
 *
 * @package Moehrenzahn\Toolkit\Api
 */
interface ViewInterface
{
    /**
     * Output template into output
     */
    public function renderTemplate();

    /**
     * Output a template by slug using WordPress get_template_part function
     *
     * @param $slug
     * @param \WP_Post|null $postObject
     */
    public function renderTemplatePart(string $slug, $postObject = null);

    /**
     * Retrieve view template HTML
     *
     * @return string
     */
    public function getHtml();

    /**
     * Retrieve HTML of a template part.
     *
     * @param string $path
     * @param null|\WP_Post $postObject
     * @param mixed|null $data
     * @return string
     */
    public function getPartial(string $path, $postObject = null, $data = null);

    /**
     * Render a template part.
     *
     * @param string $path
     * @param null|\WP_Post $postObject
     * @param mixed|null $data
     */
    public function renderPartial(string $path, $postObject = null, $data = null);

    /**
     * @param string $path Template path
     * @param string $placeholder Placeholder template path
     * @param \WP_Post|null $postObject
     * @param mixed[] $data
     * @param string $viewClass Full class name of the view type to use for the partial. Defaults to the parent view.
     */
    public function renderLazyPartial(
        string $path,
        string $placeholder,
        $postObject = null,
        $data = [],
        $viewClass = ''
    );

    /**
     * Retrieve an image by relative path from the template directory uri.
     *
     * @param string $path
     * @return string
     */
    public function getImageUrl(string $path);

    /**
     * Get a posts thumbnail image as lazy-loaded <img> tag.
     *
     * @param int $postId
     * @param string $size A WordPress image size class
     * @param array $classList List of HTML classes
     * @return string
     */
    public function getLazyThumbnail(int $postId, string $size, array $classList = []);

    /**
     * Render the native WordPress page header template. Use only once per request.
     *
     * @param string|null $name Calls for header-name.php.
     */
    public function renderHeader(string $name = null);

    /**
     * Render the native WordPress page footer template.
     *
     * @param string $name Calls for footer-name.php.
     */
    public function renderFooter(string $name = null);

    /**
     * @return \WP_Post|null
     */
    public function getPost();

    /**
     * @param \WP_Post $post
     */
    public function setPost(\WP_Post $post);

    /**
     * @param string|null $index
     * @return mixed
     */
    public function getData(string $index = null);

    /**
     * @param mixed[] $data
     */
    public function setData(array $data);

    /**
     * @param string $extension
     */
    public function setDefaultTemplateExtension(string $extension);
}
