<?php

namespace Moehrenzahn\Toolkit;

/**
 * Class AdminNotice
 *
 * @package Moehrenzahn\Toolkit\Wordpress
 */
class AdminNotice
{
    const LEVEL_ERROR = 'error';
    const LEVEL_WARNING = 'warning';
    const LEVEL_SUCCESS = 'success';
    const LEVEL_INFO = 'info';

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var \Moehrenzahn\Toolkit\Model\AdminNotice[]
     */
    private $notices = [];

    /**
     * AdminNotice constructor.
     *
     * @param \Moehrenzahn\Toolkit\Loader $loader
     */
    public function __construct(\Moehrenzahn\Toolkit\Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $level
     * @param string $text
     * @param string $page
     * @param bool $dismissible
     */
    public function add(string $level, string $text, string $page, bool $dismissible = false)
    {
        $this->notices[] = new \Moehrenzahn\Toolkit\Model\AdminNotice(
            $this->loader,
            $level,
            $text,
            $page,
            $dismissible
        );
    }
}