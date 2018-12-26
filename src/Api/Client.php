<?php

namespace Toolkit\Api;

use Toolkit\AdminNotice;
use Toolkit\AdminPage;
use Toolkit\Block;
use Toolkit\CommentMeta;
use Toolkit\CommentMetaBox;
use Toolkit\ConfigAccessor;
use Toolkit\Helper\ObjectManager;
use Toolkit\ImageSize;
use Toolkit\Javascript;
use Toolkit\Loader;
use Toolkit\PostAction;
use Toolkit\PostMetaBox;
use Toolkit\PostPreference;
use Toolkit\PostType;
use Toolkit\Shortcode;
use Toolkit\Stylesheet;
use Toolkit\TermMeta;
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
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->objectManager = new ObjectManager();
        define('TOOLKIT_ROOT_FOLDER', dirname(__DIR__));
        define('TOOLKIT_TEMPLATE_FOLDER', TOOLKIT_ROOT_FOLDER . '/Template/');
        define('TOOLKIT_PUB_URL', 'vendor/moehrenzahn/wp-toolkit/src/public/');
    }

    /**
     * Returns a new Block instance
     *
     * @param string $templatePath
     * @param string $blockClass
     * @param mixed[] $additionalParams
     * @return BlockInterface|false
     */
    public function createBlock(
        string $templatePath = '',
        string $blockClass = Block::class,
        array $additionalParams = []
    ) {
        $params = array_merge(
            ['templatePath' => $templatePath],
            $additionalParams
        );
        try {
            return $this->objectManager->create(
                $blockClass,
                $params
            );
        } catch (\Exception $exception) {
            error_log($exception->getMessage());
            return false;
        }
    }

    /**
     * @return Loader
     */
    public function getLoader()
    {
        return $this->objectManager->getSingleton(Loader::class);
    }

    /**
     * @return Javascript
     */
    public function getJavascriptManager()
    {
        return $this->objectManager->getSingleton(Javascript::class);
    }

    /**
     * @return ImageSize
     */
    public function getImageSizeManager()
    {
        return $this->objectManager->getSingleton(ImageSize::class);
    }

    /**
     * @return Shortcode
     */
    public function getShortcodeManager()
    {
        return $this->objectManager->getSingleton(Shortcode::class);
    }

    /**
     * @return ConfigAccessor
     */
    public function getConfigAccessor()
    {
        return $this->objectManager->getSingleton(ConfigAccessor::class);
    }

    /**
     * @return Stylesheet
     */
    public function getStylesheetManager()
    {
        return $this->objectManager->getSingleton(Stylesheet::class);
    }

    /**
     * @return User
     */
    public function getUserManager()
    {
        return $this->objectManager->getSingleton(User::class);
    }

    /**
     * @return Transient
     */
    public function getTransientManager()
    {
        return $this->objectManager->getSingleton(Transient::class);
    }

    /**
     * @return PostType
     */
    public function getPostTypeManager()
    {
        return $this->objectManager->getSingleton(PostType::class);
    }

    /**
     * @return PostPreference
     */
    public function getPostPreferenceManager()
    {
        return $this->objectManager->getSingleton(PostPreference::class);
    }

    /**
     * @return PostMetaBox
     */
    public function getPostMetaBoxManager()
    {
        return $this->objectManager->getSingleton(PostMetaBox::class);
    }

    /**
     * @return CommentMeta
     */
    public function getCommentMetaManager()
    {
        return $this->objectManager->getSingleton(CommentMeta::class);
    }

    /**
     * @return CommentMetaBox
     */
    public function getCommentMetaBoxManager()
    {
        return $this->objectManager->getSingleton(CommentMetaBox::class);
    }

    /**
     * @return AdminPage
     */
    public function getAdminPageManager()
    {
        return $this->objectManager->getSingleton(AdminPage::class);
    }
    /**
     * @return AdminPage\SettingsSectionBuilder
     */
    public function getSettingsSectionBuilder()
    {
        return $this->objectManager->getSingleton(AdminPage\SettingsSectionBuilder::class);
    }

    /**
     * @return AdminNotice
     */
    public function getAdminNoticeManager()
    {
        return $this->objectManager->getSingleton(AdminNotice::class);
    }

    /**
     * @return PostAction
     */
    public function getPostActionManager()
    {
        return $this->objectManager->getSingleton(PostAction::class);
    }

    /**
     * @return TermMeta
     */
    public function getTermMetaManager()
    {
        return $this->objectManager->getSingleton(TermMeta::class);
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager(): ObjectManager
    {
        return $this->objectManager;
    }
}
