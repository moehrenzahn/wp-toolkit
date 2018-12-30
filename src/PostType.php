<?php

namespace Moehrenzahn\Toolkit;

/**
 * Class PostType
 *
 * @package Moehrenzahn\Toolkit\Model
 */
class PostType
{
    /**
     * @var \Moehrenzahn\Toolkit\Model\PostType[]
     */
    private $types = [];

    /**
     * @param string $label
     * @param string $plural
     * @param string $description
     * @param string $icon
     */
    public function add(
        string $label,
        string $plural,
        string $description = '',
        string $icon = 'dashicons-admin-post'
    ) {
        $this->types[$label] = new \Moehrenzahn\Toolkit\Model\PostType(
            $label,
            $plural,
            $description,
            $icon
        );
    }

    /**
     * @return Model\PostType[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }
}
