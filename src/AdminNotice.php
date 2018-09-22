<?php
namespace Toolkit;

use Toolkit\Loader;

/**
 * Class AdminNotice
 *
 * @package Toolkit\Wordpress
 */
class AdminNotice
{
    const LEVEL_ERROR = 'error';
    const LEVEL_WARNING = 'warning';
    const LEVEL_SUCCESS = 'success';
    const LEVEL_INFO = 'info';

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
        echo "<div class='notice notice-$this->level is-dismissible'><p>$this->text</p></div>";
    }

}