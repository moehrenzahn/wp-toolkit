<?php

namespace Moehrenzahn\Toolkit\Model;

use Moehrenzahn\Toolkit\Loader;

/**
 * Class AdminNotice
 *
 * @package Moehrenzahn\Toolkit\Wordpress
 */
class AdminNotice
{
    /**
     * @var string
     */
    private $level;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $page;

    /**
     * @var bool
     */
    private $dismissible;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * AdminNotice constructor.
     *
     * @param Loader $loader
     * @param string $level
     * @param string $text
     * @param string $page
     * @param bool $dismissible
     */
    public function __construct(
        Loader $loader,
        string $level,
        string $text,
        string $page,
        bool $dismissible = false
    ) {
        $this->level = $level;
        $this->text = $text;
        $this->page = $page;
        $this->dismissible = $dismissible;
        $this->loader = $loader;

        if ($this->isValidPage()) {
            $this->loader->addAction('admin_notices', $this, 'render');
        }
    }

    /**
     * @return bool
     */
    private function isValidPage(): bool
    {
        global $pagenow;
        return ($pagenow === $this->page );
    }

    public function render()
    {
        $dismissible = $this->dismissible ? 'is-dismissible' : '';
        echo "<div class='notice notice-$this->level $dismissible'><p>$this->text</p></div>";
    }
}