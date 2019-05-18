<?php

namespace Moehrenzahn\Toolkit\Model;

use Moehrenzahn\Toolkit\View;
use Moehrenzahn\Toolkit\Loader;

/**
 * Generic Admin Page in Wordpress Dashboard
 */
class AdminPage
{
    const ACTION = 'admin_menu';

    /**
     * @var Loader
     */
    protected $loader;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var View
     */
    protected $view;

    /**
     * AdminPage constructor.
     *
     * @param Loader $loader
     * @param string $title
     * @param string $slug
     * @param string $icon
     * @param int $position
     * @param View $view
     */
    public function __construct(
        Loader $loader,
        string $title,
        string $slug,
        string $icon,
        int $position,
        View $view
    ) {
        $this->loader = $loader;
        $this->title = $title;
        $this->slug = $slug;
        $this->icon = $icon;
        $this->position = $position;
        $this->view = $view;

        $this->loader->addAction('admin_menu', $this, 'registerCallback');
    }

    /**
     * Get the full WordPress admin are url for this page
     * @return string
     */
    public function getUrl(): string
    {
        return admin_url('options-general.php?page=' . $this->slug);
    }

    public function registerCallback()
    {
        $this->register();
    }

    /**
     * Register backend page with wordpress
     */
    protected function register()
    {
        add_menu_page(
            $this->title,
            $this->title,
            "read",
            $this->slug,
            [$this->view, 'renderTemplate'],
            $this->icon,
            $this->position
        );
    }
}
