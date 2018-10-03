<?php

namespace Toolkit\Api;

use Toolkit\AdminNotice;
use Toolkit\AdminPage;
use Toolkit\Block;
use Toolkit\CommentMeta;
use Toolkit\CommentMetaBox;
use Toolkit\ImageSize;
use Toolkit\Javascript;
use Toolkit\Loader;
use Toolkit\Model\Comment\MetaAccessor;
use Toolkit\PostMetaBox;
use Toolkit\PostType;
use Toolkit\Shortcode;
use Toolkit\Stylesheet;
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
     * Returns a new Block instance
     *
     * @param string $templatePath
     * @param string $templateType
     * @return Block
     */
    public function createBlock(string $templatePath = '', string $templateType = 'phtml')
    {
        return $this->createInstance(
            Block::class,
            [
                $this->getJavascriptManager(),
                $this->getImageSizeManager(),
                $templatePath,
                $templateType
            ]
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
        return $this->getSingleton(Shortcode::class);
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
     * @return PostType
     */
    public function getPostTypeManager()
    {
        return $this->getSingleton(PostType::class);
    }

    /**
     * @return PostMetaBox
     */
    public function getPostMetaBox()
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
