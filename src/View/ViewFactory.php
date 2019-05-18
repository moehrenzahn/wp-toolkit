<?php
namespace Moehrenzahn\Toolkit\View;

use Moehrenzahn\Toolkit\Api\ViewInterface;
use Moehrenzahn\Toolkit\View;
use Moehrenzahn\Toolkit\Helper\ObjectManager;

/**
 * Class ViewFactory
 *
 * @package Moehrenzahn\Toolkit\View
 */
class ViewFactory
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * ViewFactory constructor.
     *
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Returns a new View instance
     *
     * @param string $templatePath
     * @param string $viewClass
     * @param \WP_Post|null $post
     * @param mixed[] $data
     * @return ViewInterface|false
     */
    public function create($templatePath = '', $viewClass = View::class, $post = null, $data = []): ViewInterface
    {
        $params = [
            'templatePath' => $templatePath,
            'post' => $post,
            'data' => $data,
        ];

        try {
            return $this->objectManager->create(
                $viewClass,
                $params
            );
        } catch (\Exception $exception) {
            error_log($exception->getMessage());
            return false;
        }
    }
}
