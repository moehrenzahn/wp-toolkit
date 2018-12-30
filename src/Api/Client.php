<?php

namespace Moehrenzahn\Toolkit\Api;

use Moehrenzahn\Toolkit\AdminNotice;
use Moehrenzahn\Toolkit\AdminPage;
use Moehrenzahn\Toolkit\AjaxAction;
use Moehrenzahn\Toolkit\Block;
use Moehrenzahn\Toolkit\CommentMeta;
use Moehrenzahn\Toolkit\CommentMetaBox;
use Moehrenzahn\Toolkit\ConfigAccessor;
use Moehrenzahn\Toolkit\Filter;
use Moehrenzahn\Toolkit\Head;
use Moehrenzahn\Toolkit\Helper\ObjectManager;
use Moehrenzahn\Toolkit\ImageSize;
use Moehrenzahn\Toolkit\Javascript;
use Moehrenzahn\Toolkit\Loader;
use Moehrenzahn\Toolkit\PostAction;
use Moehrenzahn\Toolkit\PostMetaBox;
use Moehrenzahn\Toolkit\PostPreference;
use Moehrenzahn\Toolkit\PostType;
use Moehrenzahn\Toolkit\Shortcode;
use Moehrenzahn\Toolkit\Stylesheet;
use Moehrenzahn\Toolkit\TermMeta;
use Moehrenzahn\Toolkit\Transient;
use Moehrenzahn\Toolkit\User;

/**
 * Class Client
 *
 * @package Moehrenzahn\Toolkit\Api
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
