<?php

namespace Toolkit\Api;

use Toolkit\AdminNotice;
use Toolkit\AdminPage;
use Toolkit\Block;
use Toolkit\CommentMeta;
use Toolkit\CommentMetaBox;
use Toolkit\ConfigAccessor;
use Toolkit\ImageSize;
use Toolkit\Javascript;
use Toolkit\Loader;
use Toolkit\Model\Comment\MetaAccessor;
use Toolkit\Model\Post\Storage\Meta;
use Toolkit\Model\Post\Storage\Tag;
use Toolkit\Model\Post\Storage\TagManager;
use Toolkit\PostAction;
use Toolkit\PostMetaBox;
use Toolkit\PostPreference;
use Toolkit\PostType;
use Toolkit\Shortcode;
use Toolkit\Stylesheet;
use Toolkit\Transient;
use Toolkit\User;

/**
 * Class Client
 *
 * @package Toolkit\Api
 */
class Client
{
    /**
     * @var array
     */
    private $instances;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        define('TOOLKIT_ROOT_FOLDER', dirname(__DIR__));
        define('TOOLKIT_TEMPLATE_FOLDER', TOOLKIT_ROOT_FOLDER . '/Template/');
    }

    /**
     * Returns a new Block instance
     *
     * @param string $templatePath
     * @param string $blockClass
     * @param mixed[] $additionalParams
     * @return BlockInterface
     */
    public function createBlock(
        string $templatePath = '',
        string $blockClass = Block::class,
        array $additionalParams = []
    ) {
        $params = array_merge(
            [
                $this->getJavascriptManager(),
                $this->getImageSizeManager(),
                $templatePath,
            ],
            $additionalParams
        );
        return $this->createInstance(
            $blockClass,
            $params
        );
    }

    /**
     * @return Loader
     */
    public function getLoader()
    {
        return $this->getSingleton(Loader::class);
    }

    /**
     * @return Javascript
     */
    public function getJavascriptManager()
    {
        return $this->getSingleton(Javascript::class);
    }

    /**
     * @return ImageSize
     */
    public function getImageSizeManager()
    {
        return $this->getSingleton(ImageSize::class);
    }

    /**
     * @return Shortcode
     */
    public function getShortcodeManager()
    {
        return $this->getSingleton(Shortcode::class, [$this->getLoader()]);
    }

    /**
     * @return ConfigAccessor
     */
    public function getConfigAccessor()
    {
        return $this->getSingleton(ConfigAccessor::class);
    }

    /**
     * @return Stylesheet
     */
    public function getStylesheetManager()
    {
        return $this->getSingleton(Stylesheet::class, [$this->getLoader()]);
    }

    /**
     * @return User
     */
    public function getUserManager()
    {
        return $this->getSingleton(User::class);
    }

    /**
     * @return Transient
     */
    public function getTransientManager()
    {
        return $this->getSingleton(Transient::class);
    }

    /**
     * @return PostType
     */
    public function getPostTypeManager()
    {
        return $this->getSingleton(PostType::class);
    }

    /**
     * @return PostPreference
     */
    public function getPostPreferenceManager()
    {
        return $this->getSingleton(
            PostPreference::class,
            [
                $this->getSingleton(Meta::class, [$this->getSingleton(TagManager::class)]),
                $this->getSingleton(Tag::class, [$this->getSingleton(TagManager::class)]),
            ]
        );
    }

    /**
     * @return PostMetaBox
     */
    public function getPostMetaBoxManager()
    {
        return $this->getSingleton(
            PostMetaBox::class,
            [$this->getLoader(), $this->getJavascriptManager(), $this->getImageSizeManager()]
        );
    }

    /**
     * @return CommentMeta
     */
    public function getCommentMetaManager()
    {
        return $this->getSingleton(
            CommentMeta::class,
            [$this->getSingleton(MetaAccessor::class)]
        );
    }

    /**
     * @return CommentMetaBox
     */
    public function getCommentMetaBoxManager()
    {
        return $this->getSingleton(
            CommentMetaBox::class,
            [
                $this->getLoader(),
                $this->getJavascriptManager(),
                $this->getImageSizeManager(),
                $this->getSingleton(MetaAccessor::class)
            ]
        );
    }

    /**
     * @return AdminPage
     */
    public function getAdminPageManager()
    {
        return $this->getSingleton(
            AdminPage::class,
            [
                $this->getLoader(),
                $this->getJavascriptManager(),
                $this->getImageSizeManager()
            ]
        );
    }
    /**
     * @return AdminPage\SettingsSectionBuilder
     */
    public function getSettingsSectionBuilder()
    {
        return $this->getSingleton(
            AdminPage\SettingsSectionBuilder::class,
            [
                $this,
                $this->createInstance(AdminPage\SettingBuilder::class, [$this]),
                $this->getImageSizeManager()
            ]
        );
    }

    /**
     * @return AdminNotice
     */
    public function getAdminNoticeManager()
    {
        return $this->getSingleton(
            AdminNotice::class,
            [$this->getLoader()]
        );
    }

    /**
     * @return PostAction
     */
    public function getPostActionManager()
    {
        return $this->getSingleton(
            PostAction::class,
            [$this->getLoader()]
        );
    }

    /**
     * @param string $class Fully qualified class name of object
     * @param mixed[] $args object dependencies
     * @return mixed Requested object
     */
    private function getSingleton(string $class, array $args = [])
    {
        if (!isset($this->instances[$class])) {
            $this->instances[$class] = $this->createInstance($class, $args);
        }

        return $this->instances[$class];
    }

    /**
     * @param string $class
     * @param mixed[] $args
     * @return mixed
     */
    private function createInstance(string $class, array $args = [])
    {
        $instance = new $class(...$args);

        return $instance;
    }
}
