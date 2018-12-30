<?php
namespace Moehrenzahn\Toolkit\Model\Action;

use Moehrenzahn\Toolkit\Api\ActionInterface;
use Moehrenzahn\Toolkit\Api\BlockInterface;
use Moehrenzahn\Toolkit\Helper\ObjectManager;

/**
 * Class TemplateAjax
 *
 * @package Moehrenzahn\Toolkit\Model\Action
 */
class TemplateAjax implements ActionInterface
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * TemplateAjax constructor.
     *
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param mixed[] $request
     */
    public function doAction(array $request)
    {
        /** @var BlockInterface $block */
        $block = $this->objectManager->create(
            stripslashes($request['blockClass']),
            [
                'templatePath' => $request['templatePath'],
                'post' => get_post($request['postId']),
            ]
        );
        $block->renderTemplate();
    }
}
