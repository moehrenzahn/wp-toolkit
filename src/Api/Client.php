<?php

namespace Toolkit\Api;

use Toolkit\AdminNotice;
use Toolkit\AdminPage;
use Toolkit\AjaxAction;
use Toolkit\Block;
use Toolkit\CommentMeta;
use Toolkit\CommentMetaBox;
use Toolkit\ConfigAccessor;
use Toolkit\Filter;
use Toolkit\Head;
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
     * @return Loader
     */
    public function getLoader(): Loader
    {
        return $this->objectManager->getSingleton(Loader::class);
    }

    /**
     * @return Block\BlockFactory
     */
    public function getBlockFactory(): Block\BlockFactory
    {
        return $this->objectManager->getSingleton(Block\BlockFactory::class);
    }

    /**
     * @return Javascript
     */
    public function getJavascriptManager(): Javascript
    {
        return $this->objectManager->getSingleton(Javascript::class);
    }

    /**
     * @return ImageSize
     */
    public function getImageSizeManager(): ImageSize
    {
        return $this->objectManager->getSingleton(ImageSize::class);
    }

    /**
     * @return Shortcode
     */
    public function getShortcodeManager(): Shortcode
    {
        return $this->objectManager->getSingleton(Shortcode::class);
    }

    /**
     * @return Stylesheet
     */
    public function getStylesheetManager(): Stylesheet
    {
        return $this->objectManager->getSingleton(Stylesheet::class);
    }

    /**
     * @return User
     */
    public function getUserManager(): User
    {
        return $this->objectManager->getSingleton(User::class);
    }

    /**
     * @return Transient
     */
    public function getTransientManager(): Transient
    {
        return $this->objectManager->getSingleton(Transient::class);
    }

    /**
     * @return PostType
     */
    public function getPostTypeManager(): PostType
    {
        return $this->objectManager->getSingleton(PostType::class);
    }

    /**
     * @return PostPreference
     */
    public function getPostPreferenceManager(): PostPreference
    {
        return $this->objectManager->getSingleton(PostPreference::class);
    }

    /**
     * @return PostMetaBox
     */
    public function getPostMetaBoxManager(): PostMetaBox
    {
        return $this->objectManager->getSingleton(PostMetaBox::class);
    }

    /**
     * @return CommentMeta
     */
    public function getCommentMetaManager(): CommentMeta
    {
        return $this->objectManager->getSingleton(CommentMeta::class);
    }

    /**
     * @return CommentMetaBox
     */
    public function getCommentMetaBoxManager(): CommentMetaBox
    {
        return $this->objectManager->getSingleton(CommentMetaBox::class);
    }

    /**
     * @return AdminPage
     */
    public function getAdminPageManager(): AdminPage
    {
        return $this->objectManager->getSingleton(AdminPage::class);
    }

    /**
     * @return AdminNotice
     */
    public function getAdminNoticeManager(): AdminNotice
    {
        return $this->objectManager->getSingleton(AdminNotice::class);
    }

    /**
     * @return AjaxAction
     */
    public function getAjaxActionManager(): AjaxAction
    {
        return $this->objectManager->getSingleton(AjaxAction::class);
    }

    /**
     * @return PostAction
     */
    public function getPostActionManager(): PostAction
    {
        return $this->objectManager->getSingleton(PostAction::class);
    }

    /**
     * @return TermMeta
     */
    public function getTermMetaManager(): TermMeta
    {
        return $this->objectManager->getSingleton(TermMeta::class);
    }

    /**
     * @return Filter
     */
    public function getFilterManager(): Filter
    {
        return $this->objectManager->getSingleton(Filter::class);
    }

    /**
     * @return Head
     */
    public function getHeadManager(): Head
    {
        return $this->objectManager->getSingleton(Head::class);
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager(): ObjectManager
    {
        return $this->objectManager;
    }

    /**
     * @return AdminPage\SettingsSectionBuilder
     */
    public function getSettingsSectionBuilder(): AdminPage\SettingsSectionBuilder
    {
        return $this->objectManager->getSingleton(AdminPage\SettingsSectionBuilder::class);
    }
}
