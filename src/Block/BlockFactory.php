<?php
namespace Moehrenzahn\Toolkit\Block;

use Moehrenzahn\Toolkit\Api\BlockInterface;
use Moehrenzahn\Toolkit\Block;
use Moehrenzahn\Toolkit\Helper\ObjectManager;

/**
 * Class BlockFactory
 *
 * @package Moehrenzahn\Toolkit\Block
 */
class BlockFactory
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * BlockFactory constructor.
     *
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Returns a new Block instance
     *
     * @param string $templatePath
     * @param string $blockClass
     * @param \WP_Post|null $post
     * @param mixed[] $data
     * @return BlockInterface|false
     */
    public function create($templatePath = '', $blockClass = Block::class, $post = null, $data = []): BlockInterface
    {
        $params = [
            'templatePath' => $templatePath,
            'post' => $post,
            'data' => $data,
        ];

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
}
