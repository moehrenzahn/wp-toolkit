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
     * @param $labels   Use to override individual default labels
     * @param $params   Use to override individual default params (other than labels)
     */
    public function add(
        string $label,
        string $plural,
        string $description = '',
        string $icon = 'dashicons-admin-post',
        array $labels = [],
        array $params = []
    ) {
        $this->types[$label] = new \Moehrenzahn\Toolkit\Model\PostType(
            $label,
            $plural,
            $description,
            $icon,
            $labels,
            $params
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
