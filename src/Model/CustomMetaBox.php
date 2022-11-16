<?php

namespace Moehrenzahn\Toolkit\Model;

use Moehrenzahn\Toolkit\View;
use Moehrenzahn\Toolkit\Helper\Request;
use Moehrenzahn\Toolkit\Loader;
use Moehrenzahn\Toolkit\Model\Post\PostPreference;

/**
 * Class CustomMetaBox
 *
 * @package Moehrenzahn\Toolkit\Model
 */
class CustomMetaBox
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var PostPreference[]
     */
    private $postPreferences;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $screenName;

    /**
     * @var string
     */
    private $context;

    /**
     * @var View
     */
    private $view;

    /**
     * @var Loader
     */
    protected $loader;

    /**
     * CustomMetaBox constructor.
     *
     * @param string $title
     * @param string $slug
     * @param string $screenName
     * @param string $context
     * @param PostPreference[] $postPreferences
     * @param View\Post\MetaBox $view
     * @param Loader $loader
     */
    public function __construct(
        string $title,
        string $slug,
        string $screenName,
        string $context,
        array $postPreferences,
        View\Post\MetaBox $view,
        Loader $loader
    ) {
        $this->title = $title;
        $this->slug = $slug;
        $this->screenName = $screenName;
        $this->context = $context;
        $this->postPreferences = $postPreferences;
        $this->view = $view;
        $this->loader = $loader;

        $this->loader->addAction('add_meta_boxes', $this, 'register');
        $this->loader->addAction('save_post', $this, 'handleSave');
    }

    /**
     * Register backend page with wordpress
     */
    public function register()
    {
        add_meta_box(
            $this->slug,
            $this->title,
            [$this->view, 'renderTemplate'],
            $this->screenName,
            $this->context,
            'high'
        );
    }

    /**
     * WP Core hook target on post save.
     *
     * @param int $postId
     */
    public function handleSave($postId)
    {
        if (Request::isAutosave()
            || !current_user_can('edit_post', $postId)
        ) {
            return;
        }

        foreach ($this->postPreferences as $preference) {
            $preferenceId = $preference->getId();
            if (isset($_REQUEST[$preferenceId])) {
                $newValue = $_REQUEST[$preferenceId];
                $preference->setValue($newValue, $postId);
            }
        }
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
